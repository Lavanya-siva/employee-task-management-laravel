<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    protected $signature = 'user:create';

    protected $description = 'Create a user from terminal';

    public function handle()
    {
        $firstname  = $this->ask('Enter first name');
        $middlename = $this->ask('Enter middle name (optional)', null);
        $surname    = $this->ask('Enter surname');
        $email      = $this->ask('Enter email');
        $phone_no   = $this->ask('Enter phone number');
        do {
        $password = $this->secret('Enter password');
        if (empty($password)) {
          $this->error('Password cannot be empty.');
        }
        } while (empty($password));
        $terms_cond = $this->confirm('Do you accept terms & conditions?');
        if (! $terms_cond) {
        $this->error('You must accept terms & conditions.');
        return Command::FAILURE;
        }

        $validator = Validator::make([
            'firstname'  => $firstname,
            'surname'    => $surname,
            'email'      => $email,
            'phone_no'   => $phone_no,
        ], [
            'firstname'  => 'required|string|min:2',
            'surname'    => 'required|string|min:1',
            'email'      => 'required|email|unique:users,email',
            'phone_no'   => 'required|digits_between:8,15|unique:users,phone_no',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return Command::FAILURE;
        }

        if (! $this->confirm('Do you want to create this user?')) {
            $this->warn('User creation cancelled.');
            return Command::SUCCESS;
        }

        $user=User::create([
            'firstname'  => $firstname,
            'middlename' => $middlename,
            'surname'    => $surname,
            'email'      => $email,
            'phone_no'   => $phone_no,
            'password'   => Hash::make($password),
            'terms_cond' => true,
        ]);

        $this->info("User {$user->email} created successfully!");
    }
}
