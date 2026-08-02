<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AttendanceController extends Controller
{

    public function index()
    {

        $attendance = Attendance::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();


        return view(
            'attendance.index',
            compact('attendance')
        );

    }

     public function checkIn()
    {
        $userId = session('user_id');

        // Check if already checked in today
        $attendance = Attendance::where('user_id', $userId)
            ->whereDate('date', today())
            ->first();


        if ($attendance) {
            return back()->with('error', 'Already checked in today.');
        }


        Attendance::create([
            'user_id'  => $userId,
            'date'     => Carbon::today(),
            'check_in' => Carbon::now()->format('H:i:s'),
            'status'   => 'Present'
        ]);


        return back()->with('success', 'Check-in successful.');
    }



    public function checkOut()
    {
        $userId = session('user_id');


        $attendance = Attendance::where('user_id', $userId)
            ->whereDate('date', today())
            ->first();


        if (!$attendance) {
            return back()->with('error', 'Please check in first.');
        }


        if ($attendance->check_out) {
            return back()->with('error', 'Already checked out.');
        }


        $checkOutTime = Carbon::now();

        $checkInTime = Carbon::parse(
            $attendance->date->format('Y-m-d').' '.$attendance->check_in
        );

        $hoursWorked = $checkInTime->diffInMinutes($checkOutTime) / 60;

        $status = $hoursWorked >= 8 ? 'Present' : 'Absent';


        $attendance->update([
            'check_out' => $checkOutTime->format('H:i:s'),
            'status'    => $status
        ]);


        $message = $status === 'Present'
            ? 'Check-out successful. You worked '.round($hoursWorked, 2).' hours — marked Present.'
            : 'Check-out successful. You worked '.round($hoursWorked, 2).' hours (under 8) — marked Absent.';


        return back()->with('success', $message);
    }

}