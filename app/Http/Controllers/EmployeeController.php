<?php

namespace App\Http\Controllers;

use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::select(
            'id',
            'firstname',
            'middlename',
            'surname',
            'email',
            'phone_no',
            'role',
            'manager_id',
            'created_at'
        )
        ->orderBy('firstname')
        ->get();


        return view('employees.index', [
            'employees' => $employees
        ]);
    }

    public function destroy(User $employee)
{
    $employee->delete();
    return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
}
}