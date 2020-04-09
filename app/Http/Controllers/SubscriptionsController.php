<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;
use App\Plan;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegistrationRequest;
use App\Subscription;

class SubscriptionsController extends Controller
{
	use RegistersUsers;

	public function store(RegistrationRequest $request) {

		$user = User::create([
			'name' => $request['name'],
			'email' => $request['email'],
			'username' => $request['username'],
			'password' => Hash::make($request['password']),
			/*'address' => $request['address'],
			'city' => $request['city'],
			'state' => $request['state'],*/
			/*'postal_code' => $request['postal_code'],
			'country' => $request['country'],
			'phone' => preg_replace('/[^0-9]/', '', $request['phone'])*/

		]);

		auth()->login($user);

		// get the plan after submitting the form
		$plan = Plan::findOrFail( $request->plan );

		// Subscribe the user
		$request->user()->newSubscription( $plan->name,
			$plan->braintree_plan )->create( $request->payment_method_nonce );

		//$confirmSubscription = DB::table('subscriptions')->where('user_id', $user->id)->get();

		//if(!is_null($confirmSubscription))
		if (Subscription::where('user_id', '=', $user->id)->count() > 0) {
			$user->assignRole('member');
			return redirect( '/' );
		} else {
			session()->flash('message', "There was an error signing up");
			return redirect()->back();
		}

	}

}
