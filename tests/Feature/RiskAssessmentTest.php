<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\RiskQuestion;
use Laravel\Sanctum\Sanctum;
use Database\Seeders\RiskQuestionSeeder;


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
        'registration_status' => 'personal_info' // 👈 REQUIRED
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

}
