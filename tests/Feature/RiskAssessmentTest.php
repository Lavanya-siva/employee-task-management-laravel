<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;


class RiskAssessmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_user_cannot_access_risk_endpoints()
    {
        $this->getJson('/api/user/risk-questions')
            ->assertStatus(401);

        $this->postJson('/api/user/risk-answer', [])
            ->assertStatus(401);

        $this->getJson('/api/user/risk-profile')
            ->assertStatus(401);
    }

  /** @test */
public function authenticated_user_can_submit_risk_answer()
{
    $this->seed(\Database\Seeders\RiskQuestionSeeder::class);

    $user = User::factory()->create([
       'registration_status' => 'documents_uploaded'
    ]);

    Sanctum::actingAs($user);

    $this->postJson('/api/user/risk-answer', [
            'question_id' => 1,
            'option_selected' => 1
        ])
        ->assertStatus(200)
        ->assertJson([
            'success' => true
        ]);
}
 /** @test */
    public function risk_answer_submission_fails_with_invalid_data()
    {
        $user = User::factory()->create([
              'registration_status' => 'documents_uploaded'
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/user/risk-answer', [
            // missing question_id & option_selected
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'success' => false
                 ]);
    }
  /** @test */
    public function risk_answer_submission_fails_with_incorrect_data()
    {
        $user = User::factory()->create([ 'registration_status' => 'documents_uploaded']);
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/user/risk-answer', [
            'question_id' => 9999,    // question does not exist
            'option_selected' => 99   // invalid option
        ]);

        $response->assertStatus(422)
                 ->assertJson(['success' => false]);
    }
     /** @test */
    public function cannot_submit_risk_answer_if_registration_status_invalid()
    {
        $user = User::factory()->create([
            'registration_status' => 'started' // invalid stage
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/user/risk-answer', [
            'question_id' => 1,
            'option_selected' => 1
        ]);

        $response->assertStatus(403) // Forbidden
                 ->assertJson([
                     'success' => false,
                     'message' => 'Access denied. Document not uploaded yet.'
                 ]);
    }
}
