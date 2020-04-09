<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Braintree_Transaction;


class PaymentsController extends Controller
{

	public function process(Request $request)
	{
		$payload = $request->input('payload', false);
		$nonce = $payload['nonce'];

		$status = Braintree_Transaction::sale([
			'amount' => '9.99',
			'paymentMethodNonce' => $nonce,
			'options' => [
				'submitForSettlement' => True
			]
		]);

		return response()->json($status);
	}

	public function subscribe(Request $request)
	{
		try {
			$payload = $request->input('payload', false);
			$nonce = $payload['nonce'];

			$user = User::first();
			$user->newSubscription('Monthly Subscription', 'pmpro_1')->create($nonce);

			return response()->json(['success' => true]);
		} catch (\Exception $ex) {
			return response()->json(['success' => false]);
		}
	}
}
