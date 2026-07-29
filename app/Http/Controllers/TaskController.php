<?php

namespace App\Http\Controllers;


use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;



class TaskController extends Controller
{


public function index()
{

    $tasks = Task::with([
        'employee',
        'creator'
    ])
    ->latest()
    ->get();


    $employees = User::where('role','user')
        ->get();



    return view(
        'tasks.index',
        compact(
            'tasks',
            'employees'
        )
    );

}




public function store(Request $request)
{

   $request->validate([

    'title'=>'required',

    'description'=>'nullable',

    'assigned_to'=>'required|exists:users,id',

    'priority'=>'required|in:low,medium,high',

    'due_date'=>'required|date|after:today'

]);



    Task::create([

'created_by'=>session('user_id'),

'assigned_to'=>$request->assigned_to,

'title'=>$request->title,

'description'=>$request->description,

'priority'=>$request->priority,

'due_date'=>$request->due_date

]);



    return back()->with(
        'success',
        'Task created successfully'
    );

}







public function updateStatus(
Request $request,
Task $task
)
{


$request->validate([

'status'=>'required'

]);



$task->update([

'status'=>$request->status

]);



return back();

}



}