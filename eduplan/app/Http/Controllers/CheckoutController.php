<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Exception;

class CheckoutController extends Controller
{
    // Show cart checkout
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('student_id', $userId)->with('course')->get();
        $total = (float) $cartItems->sum(fn($i) => $i->course->fees ?? 0);
        $singlePurchase = false;

        return view('checkout.index', compact('cartItems', 'total', 'singlePurchase'));
    }

    // Buy Now single course
    public function buyNow($courseId)
    {
        $course = Course::findOrFail($courseId);

        $cartItems = collect([ (object)[ 'course' => $course ] ]);
        $total = $course->fees ?? 0;
        $singlePurchase = true;

        return view('checkout.index', compact('cartItems', 'total', 'singlePurchase'));
    }

    // Create Stripe PaymentIntent & pre-create pending order
    public function createPaymentIntent(Request $request)
    {
        try {
            $userId = Auth::id();
            if (!$userId) return response()->json(['error' => 'Unauthenticated.'], 401);

            $coursesInput = $request->input('courses', []);
            $singlePurchase = filter_var($request->input('singlePurchase', false), FILTER_VALIDATE_BOOLEAN);

            $courses = collect();

            if ($singlePurchase) {
                if (empty($coursesInput) || !is_array($coursesInput)) {
                    return response()->json(['error' => 'No course selected for single purchase.'], 422);
                }
                $courses = Course::whereIn('id', $coursesInput)->get();
            } else {
                $cartQuery = Cart::where('student_id', $userId)->with('course');
                if (!empty($coursesInput)) $cartQuery->whereIn('course_id', $coursesInput);
                $cartItems = $cartQuery->get();
                $cartItems->each(fn($item) => $item->course ? $courses->push($item->course) : null);
            }

            if ($courses->isEmpty()) return response()->json(['error' => 'No courses found for checkout.'], 422);

            $total = (float) $courses->sum(fn($c) => $c->fees ?? 0);
            $amountPaise = (int) round($total * 100);

            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = PaymentIntent::create([
                'amount' => $amountPaise,
                'currency' => 'inr',
                'payment_method_types' => ['card'],
                'metadata' => [
                    'student_id' => $userId,
                    'single_purchase' => $singlePurchase ? '1' : '0',
                    'courses' => implode(',', $courses->pluck('id')->toArray()),
                ],
            ]);

            $order = Order::create([
                'student_id' => $userId,
                'total_amount' => $total,
                'courses' => json_encode($courses->pluck('id')->toArray()),
                'payment_status' => 'pending',
                'stripe_payment_id' => $paymentIntent->id,
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'order_id' => $order->id,
            ]);

        } catch (Exception $e) {
            Log::error('createPaymentIntent error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

     public function complete(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|integer',
            'payment_id' => 'required|string',
        ]);

        try {
            $userId = Auth::id();
            if (!$userId) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            // Find order
            $order = Order::find($request->order_id);
            if (!$order) {
                return response()->json(['error' => 'Order not found.'], 404);
            }

            // Verify payment with Stripe
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = PaymentIntent::retrieve($request->payment_id);

            if (!in_array($paymentIntent->status, ['succeeded', 'requires_capture'])) {
                return response()->json(['error' => 'Payment not completed.'], 400);
            }

            // Mark order as paid
            $order->update([
                'payment_status'    => 'paid',
                'stripe_payment_id' => $paymentIntent->id,
            ]);

            // Extract course IDs
            $courseIds = $request->input('courses', json_decode($order->courses, true));

            if (!empty($courseIds)) {
                $now = now();
                $rows = [];

                foreach ($courseIds as $courseId) {
                    $rows[] = [
                        'user_id'    => $userId,
                        'course_id'  => $courseId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                // ✅ Save purchased courses to purchases table (avoid duplicates)
                DB::table('purchases')->insertOrIgnore($rows);
            }

            // ✅ If it's not a single course checkout, remove those from cart
            $singlePurchase = filter_var($request->input('singlePurchase', false), FILTER_VALIDATE_BOOLEAN);
            if (!$singlePurchase && !empty($courseIds)) {
                Cart::where('student_id', $userId)
                    ->whereIn('course_id', $courseIds)
                    ->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment completed and courses added to My Courses!',
                'order_id' => $order->id,
            ]);
        } catch (Exception $e) {
            Log::error('Complete payment error: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function show(Order $order)
    {
        $userId = Auth::id();
        if ($order->student_id !== $userId) {
            abort(403);
        }

        $courses = Course::whereIn('id', json_decode($order->courses ?? '[]'))->get();

        return view('orders.show', compact('order', 'courses'));
    }
}
