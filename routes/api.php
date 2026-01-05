<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\RiskAssessmentController;
use App\Http\Controllers\DocumentController;


Route::prefix('user')->group(function () {
    Route::post('create-account', [CreateAccountController::class, 'createAccount']);
    Route::post('login', [AuthController::class, 'login']); 
     Route::post('verify-otp', [OtpController::class, 'verifyOtp']);
    Route::post('resend-otp', [OtpController::class, 'resendOtp']);
    
});
Route::prefix('user')->middleware(['auth:sanctum','sanctum.expiry', 'otp.verified'])->group(function () {
    Route::post('personal-info', [PersonalInfoController::class, 'savePersonalInfo']);
});


Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::get('/risk-questions', [RiskAssessmentController::class, 'getQuestions']);
    Route::post('/risk-answer', [RiskAssessmentController::class, 'submitAnswer']);
    Route::get('/risk-profile', [RiskAssessmentController::class, 'finalRiskProfile']);
     Route::get('/documents', [DocumentController::class, 'viewDocuments'])->name('documents.view');
    Route::post('/documents-upload', [DocumentController::class, 'upload'])->name('documents.upload');
    Route::post('/documents-reupload', [DocumentController::class, 'reupload'])->name('documents.reupload');
});
