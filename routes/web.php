<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
 use App\Http\Controllers\ManagerAssignmentController;
 use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;
Route::get('/', function () {
    return redirect('/login');
});


Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');

Route::get(
    '/create-account',
    [AuthController::class, 'createAccount']
)->name('createAccount');

Route::get('/otp-verify', [AuthController::class, 'otpVerify'])->name('otpVerify');
Route::get('/upload-documents',[DocumentController::class,'uploadDoc'])->name('uploadDoc');

Route::get('/resend-otp', [AuthController::class, 'resendOtp'])->name('otpVerify');
Route::get('/employees', [EmployeeController::class, 'index'])
    ->name('employees.index');
   


Route::get(
'/manager-assignment',
[ManagerAssignmentController::class,'index']
);


Route::post(
'/manager-assignment',
[ManagerAssignmentController::class,'assign']
);

use App\Http\Controllers\TaskController;



Route::get(
'/tasks',
[TaskController::class,'index']
);





Route::post(
'/tasks',
[TaskController::class,'store']
);



Route::post(
'/tasks/{task}/status',
[TaskController::class,'updateStatus']
);

Route::post('/logout', [
    AuthController::class,
    'logout'
])
->name('logout');

Route::post('/login', [AuthController::class, 'login']);





Route::middleware(['auth'])->group(function () {

    Route::get(
        '/my-attendance',
        [AttendanceController::class,'index']
    )->name('attendance.index');


    Route::get(
        '/leave-requests',
        [LeaveRequestController::class,'index']
    )->name('leave-requests.index');

});
Route::post(
    '/leave-requests',
    [LeaveRequestController::class,'store']
)->name('leave-requests.store');


//attendence


Route::post('/attendance/checkin', 
    [AttendanceController::class, 'checkIn']
)->name('attendance.checkin');


Route::post('/attendance/checkout', 
    [AttendanceController::class, 'checkOut']
)->name('attendance.checkout');


use App\Http\Controllers\ProfileController;



Route::get(
    '/profile',
    [ProfileController::class,'index']
)
->name('profile');



Route::post(
    '/profile/update',
    [ProfileController::class,'update']
)
->name('profile.update');

use App\Http\Controllers\DashboardController;


Route::get('/dashboard',
[DashboardController::class,'index'])
->name('dashboard');

Route::post('/employee/{id}/wish', 
    [DashboardController::class,'sendWish']
)->name('employee.wish');

Route::post(
    '/leave-requests/{id}/approve',
    [LeaveRequestController::class,'approve']
)->name('leave-requests.approve');


Route::post(
    '/leave-requests/{id}/reject',
    [LeaveRequestController::class,'reject']
)->name('leave-requests.reject');

Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');