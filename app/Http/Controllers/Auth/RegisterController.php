<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            /*
             * Not sure about pin requirements, emphasis seems to be on uniqueness to allow login with just pin rather
             * than secondary security check SO, going with the former.
             */
            'pin' => ['required', 'regex:/\b\d{4,8}\b/', 'unique:users,pin']
        ],
        [
            'pin.regex' => 'The PIN must be 4 to 8 digits. Please try another PIN',
            'pin.unique' => 'The PIN is already taken. Please try another PIN',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     * @throws \Exception
     */
    protected function create(array $data)
    {
        $user = null;

        DB::transaction(function () use ($data, &$user) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'pin' => $data['pin']
            ]);
            $user->accounts()->create(['type' => Account::TYPE_CHECKING]);
            $user->accounts()->create(['type' => Account::TYPE_SAVING]);
        });

        //TODO: Handle better
        if ($user === null) {
            throw new \Exception('Could not create user or account records at this time.');
        }
        return $user;
    }
}
