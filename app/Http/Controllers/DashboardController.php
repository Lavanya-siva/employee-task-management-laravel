<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use App\Mail\BirthdayWishFromEmployeeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {

        // Total employees
        $employeeCount = User::count();



        // Total managers
        $managerCount = User::where('role','manager')
            ->count();



        // Pending tasks
        $pendingTasks = Task::where('status','pending')
            ->count();



        // Today's birthdays

        $today = Carbon::today();


        $birthdayBabies = User::whereHas(
            'personalInfo',
            function($query) use ($today){

                $query->whereMonth(
                    'dob',
                    $today->month
                )
                ->whereDay(
                    'dob',
                    $today->day
                );

            }

        )
        ->with('personalInfo')
        ->get();



        return view('auth.dashboard',compact(

            'employeeCount',
            'managerCount',
            'pendingTasks',
            'birthdayBabies'

        ));


    }




public function sendWish($id)
{
    $receiver = User::findOrFail($id);

    $senderId = session('user_id');

    $sender = User::findOrFail($senderId);


    Mail::to($receiver->email)
        ->send(
            new BirthdayWishFromEmployeeMail(
                $receiver,
                $sender
            )
        );


    return back()->with(
        'success',
        'Birthday wish sent successfully to '.$receiver->firstname.'!'
    );
}
}