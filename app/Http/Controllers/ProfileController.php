<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPersonalInfo;



class ProfileController extends Controller
{


    public function index()
    {

        $userId = session('user_id');


        $user = User::find($userId);


        $personalInfo = UserPersonalInfo::where(
            'user_id',
            $userId
        )->first();



        return view(
            'profile',
            compact(
                'user',
                'personalInfo'
            )
        );

    }




    public function update(Request $request)
    {


        $request->validate([

            'dob'=>'nullable|date',

            'phone'=>'nullable|string|max:15',

            'gender'=>'nullable|in:Male,Female,Other',

            'address'=>'nullable|string'

        ]);




        UserPersonalInfo::updateOrCreate(

            [

                'user_id'=>session('user_id')

            ],


            [

                'dob'=>$request->dob,

                'phone'=>$request->phone,

                'gender'=>$request->gender,

                'address'=>$request->address

            ]

        );



        return back()
            ->with(
                'success',
                'Profile updated successfully'
            );

    }



}