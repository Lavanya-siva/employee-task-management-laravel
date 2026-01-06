<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\RiskAssessment;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function assignManagerToUser(Request $request)
{
    
    $authUser = $request->user('sanctum'); 
    
    //check policy

    if (!$authUser || !$authUser->can('adminCheck', User::class)) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Admin access required.'
        ], 403);
    }

    $request->validate([
        'user_id'    => 'required|integer',
        'manager_id' => 'required|integer',
    ]);

    // Check manager existence + role
    $manager = User::where('id', $request->manager_id)
                   ->where('role', 'manager')
                   ->first();

    if (!$manager) {
        return response()->json([
            'success' => false,
            'message' => 'Manager not found or not a manager.'
        ], 404);
    } // new id or existing id with wrong role

    // Check user existence + role
    $user = User::where('id', $request->user_id)
                ->where('role', 'user')
                ->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found or not a valid user.'
        ], 404);
    }

    // Assign manager
    $user->manager_id = $manager->id;
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Manager assigned to user successfully'
    ]);
}


    public function viewAllUsersWithPersonalInfo(Request $request)
    { 
       $authUser = $request->user('sanctum');

    //check policy
    if (!$authUser || !$authUser->can('adminCheck', User::class)) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Admin access required.'
        ], 403);
    }

        $users = User::with('personalInfo')->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

     public function setDocumentStatus(Request $request)
    {
        
        $authUser = $request->user('sanctum');
        //check policy
        if (!$authUser || !$authUser->can('adminCheck', User::class)) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Admin access required.'
        ], 403);
        }
        
        $request->validate([
            'document_id' => 'required|integer',
            'status' => 'required|in:approved,rejected'
        ]);
        $document = Document::find($request->document_id);
        if (!$document) {
        return response()->json([
            'success' => false,
            'message' => 'Document not found'
        ], 404);
        }
        $document->current_status = $request->status;
        $document->save();
        
        return response()->json([
            'success' => true,
            'message' => "Document status set to {$request->status}",
        ]);
    }

    // Get final status of a user
    public function getUserFinalStatus($user_id, Request $request)
    {
        $authUser = $request->user('sanctum');
        //check policy
        if (!$authUser || !$authUser->can('adminCheck', User::class)) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Admin access required.'
        ], 403);
        }

       $user = User::find($user_id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $documents = Document::where('users_id', $user->id)->get();
        $allDocsAccepted = $documents->count() === 2 && $documents->every(fn($doc) => $doc->current_status === 'approved');
        $finalStatus = $allDocsAccepted  ? 'Approved' : 'Rejected';

        return response()->json([
            'success' => true,
            'user' => $user,
            'documents' => $documents,
           'final_status' => $finalStatus
        ]);
    }
}
