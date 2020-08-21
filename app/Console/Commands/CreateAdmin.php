<?php

namespace App\Console\Commands;

use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register an admin user in database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $firstname = $this->ask('Firstname?', 'Super');
        $lastname = $this->ask('Lastname?', 'Admin');
        $email = $this->askValid(
            'Email?', 
            'email', 
            [
                'required', 'email', 'unique:users,email'
            ], 
            false, 
            'admin@admin.org'
        );

        $password = $this->askValid(
            'Password?', 
            'password', 
            [
                'required', 'string', 'between:3,100'
            ], 
            true
        );


        $admin = User::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $admin->roles()->attach(Role::where('slug', 'admin')->first());

        $this->info('Admin account created. Login allowed with this email address: '.$email . ' and specified password.');

        return 0;
    }

    protected function askValid(string $question, string $field, array $rules, bool $secret = false, string $default = null)
    {
        $value = $secret ? $this->secret($question) : $this->ask($question, $default);

        if($message = $this->validateInput($rules, $field, $value)) {
            $this->error($message);

            return $this->askValid($question, $field, $rules, $secret, $default);
        }

        return $value;
    }


    protected function validateInput(array $rules, string $fieldName, string $value)
    {
        $validator = Validator::make([
            $fieldName => $value
        ], [
            $fieldName => $rules
        ]);

        return $validator->fails()
            ? $validator->errors()->first($fieldName)
            : null;
    }
}
