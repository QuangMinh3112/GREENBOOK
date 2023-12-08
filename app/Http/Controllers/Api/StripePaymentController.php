<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripePayment(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        if ($order) {
            try {
                $cardInfo = [
                    'number' => $request->input('card_number'),
                    'exp_month' => $request->input('card_exp_month'),
                    'exp_year' => $request->input('card_exp_year'),
                    'cvc' => $request->input('card_cvc'),
                ];

                if (!$order->total || !is_numeric($order->total) || $order->total <= 0) {
                    return response()->json(['message' => 'Invalid total amount'], 400);
                }
                $stripe = new \Stripe\StripeClient('sk_test_51NDAm0IkpZgahn39ZiU9BFT3mRDPEc8mE1ezs36qJV4x4E4w5jziC4CpVbjHb8yUpjDnpmG3TxuZIDOh3uPyiQM000c89bFy2D');
                $token = $stripe->tokens->create(['card' => $cardInfo]);
                $response = $stripe->charges->create([
                    'amount' => $order->total,
                    'currency' => 'VND',
                    'source' => $token->id,
                    'payment_method' => 'pm_card_visa',
                ]);
                $order->payment = "Paid";
                $order->save();

                return response()->json(['message' => 'Success', 'order' => $order], 201);
            } catch (\Stripe\Exception\CardException $ex) {
                // dd($ex);
                return response()->json(['message' => 'Card Error', 'errors' => $ex->getMessage()], 400);
            } catch (Exception $ex) {
                // dd($ex);
                return response()->json(['message' => 'Errors', 'errors' => $ex->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'Cant find Order'], 404);
        }
    }
}
