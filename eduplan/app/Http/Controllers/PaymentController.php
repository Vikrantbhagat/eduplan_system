<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'courses' => 'required|array',
            'total_amount' => 'required|numeric',
        ]);

        $studentId = Auth::id();
        $courses = json_encode($request->courses);
        $amount = $request->total_amount * 100; // Stripe expects amount in cents

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            // Save order with payment status 'pending'
            $order = Order::create([
                'student_id' => $studentId,
                'total_amount' => $request->total_amount,
                'courses' => $courses,
                'payment_status' => 'pending',
                'stripe_payment_id' => $paymentIntent->id,
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::find($request->order_id);
        $order->payment_status = 'paid';
        $order->save();

        return response()->json(['message' => 'Payment successful and stored in database.']);
    }
}
