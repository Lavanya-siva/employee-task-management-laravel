<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManagerAssignmentController extends Controller
{

    public function index()
    {

        // Current logged in user
        $authUser = Auth::user();


        // All employees with their managers
        $employees = User::where('role','user')
            ->with('manager')
            ->get();



        // All managers
        $managers = User::where('role','manager')
            ->get();



        return view(
            'manager-assignment.index',
            compact(
                'employees',
                'managers',
                'authUser'
            )
        );

    }






    public function assign(Request $request)
    {


        // Current user
        $authUser = Auth::user();



        // Only admin can assign

        if(!$authUser || $authUser->role !== 'admin')
        {

            return back()->with(
                'error',
                'Only admin can assign managers'
            );

        }






        $request->validate([

            'user_id'=>'required|exists:users,id',

            'manager_id'=>'required|exists:users,id'

        ]);







        // Check manager role

        $manager = User::where('id',$request->manager_id)
            ->where('role','manager')
            ->first();



        if(!$manager)
        {

            return back()->with(
                'error',
                'Selected user is not a manager'
            );

        }







        // Check employee role

        $employee = User::where('id',$request->user_id)
            ->where('role','user')
            ->first();



        if(!$employee)
        {

            return back()->with(
                'error',
                'Invalid employee selected'
            );

        }







        // Assign manager

        $employee->manager_id = $manager->id;

        $employee->save();






        return back()->with(
            'success',
            'Manager assigned successfully'
        );


    }


}