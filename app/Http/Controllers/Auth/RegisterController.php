<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
	        /*'address' => 'required|string',
	        'city' => 'required|string',
	        'state' => 'required|string',*/
	        /*'postal_code' => 'required|integer',*/
	        /*'country' => 'required|string',*/
	        /*'phone' => 'required|integer',*/
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'username' => $data['username'],
			'password' => Hash::make($data['password']),
			/*'address' => $data['address'],
			'city' => $data['city'],
			'state' => $data['state'],*/
			/*'postal_code' => $data['postal_code'],*/
			/*'country' => $data['country'],*/
			/*'phone' => preg_replace('/[^0-9]/', '', $data['phone'])*/
		]);

	    $user->assignRole('member');

	   // app('App\Http\Controllers\SubscriptionsController')->store($request);

	    return $user;

    }
}
