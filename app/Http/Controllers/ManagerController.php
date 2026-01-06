<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManagerController extends Controller
{
    public function viewAssignedUsers(Request $request)
    {
        $authUser = $request->user('sanctum');

        // Policy check
        if (!$authUser || $authUser->cannot('managerCheck', User::class)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Manager access required.'
            ], 403);
        }

        // Get only users assigned to THIS manager
        $users = User::where('manager_id', $authUser->id)
            ->with('personalInfo')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }
}
