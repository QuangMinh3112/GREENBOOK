<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

use Stripe;

class StripePaymentController extends Controller
{
    //
    public function stripePayment(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            try {
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $res = $stripe->tokens->create([
                    'card' => [
                        'number' => $request->number,
                        'exp_month' => $request->exp_month,
                        'exp_year' => $request->exp_year,
                        'cvc' => $request->cvc,
                    ],
                ]);
                Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
                $response = $stripe->charges->create([
                    'amount' => $order->total,
                    'currency' => 'VND',
                    'source' => $res->id,
                    'description' => $request->description,
                ]);
                $order->payment === "Paid";
                $order->save();
                return response()->json(['message' => 'Success'], 201);
            } catch (Exception $ex) {
                return response()->json(['message' => 'Errors', 'errors' => $ex->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'Cant find Order'], 404);
        }
    }
}
