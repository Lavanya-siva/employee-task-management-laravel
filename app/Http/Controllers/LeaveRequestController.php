<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveStatusMail;

class LeaveRequestController extends Controller
{

    public function index()
{
    if(session('user_role') == 'admin')
    {
        $requests = LeaveRequest::with('user')
                    ->latest()
                    ->get();
    }
    else
    {
        $requests = LeaveRequest::where(
            'user_id',
            session('user_id')
        )
        ->latest()
        ->get();
    }


    return view(
        'leave.index',
        compact('requests')
    );
}


    public function store(Request $request)
    {

        $request->validate([

            'from_date' => 'required|date',

            'to_date' => 'required|date|after_or_equal:from_date',

            'reason' => 'required|string'

        ]);



        LeaveRequest::create([

            'user_id' =>session('user_id'),

            'from_date' => $request->from_date,

            'to_date' => $request->to_date,

            'reason' => $request->reason,

            'status' => 'Pending'

        ]);



        return redirect()
            ->route('leave-requests.index')
            ->with(
                'success',
                'Leave request submitted successfully'
            );

    }
    public function approve($id)
{

    $leave = LeaveRequest::with('user')
                ->findOrFail($id);


    $leave->update([
        'status'=>'Approved'
    ]);



    Mail::to($leave->user->email)
        ->send(new LeaveStatusMail($leave));



    return back()->with(
        'success',
        'Leave approved and email sent successfully'
    );

}
public function reject($id)
{

    $leave = LeaveRequest::with('user')
                ->findOrFail($id);



    $leave->update([
        'status'=>'Rejected'
    ]);



    Mail::to($leave->user->email)
        ->send(new LeaveStatusMail($leave));



    return back()->with(
        'success',
        'Leave rejected and email sent successfully'
    );

}

}