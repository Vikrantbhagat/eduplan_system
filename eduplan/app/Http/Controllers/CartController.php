<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{



public function index() {
    $cartItems = auth()->user()->cartItems()->with('course')->get();
    $total = $cartItems->sum(fn($item) => $item->course->fees ?? 0);
    return view('cart.index', compact('cartItems', 'total'));
}


    // Add course to cart
    public function addToCart($courseId)
    {
        $studentId = Auth::id();

        // Prevent duplicate course in cart
        $exists = Cart::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Course already in cart.');
        }

        Cart::create([
            'student_id' => $studentId,
            'course_id' => $courseId,
        ]);

        return redirect()->back()->with('success', 'Course added to cart!');
    }

    // View cart
    public function viewCart()
    {
        $studentId = Auth::id();
        $cartItems = Cart::with('course')->where('student_id', $studentId)->get();

        return view('cart.index', compact('cartItems'));
    }

    // Remove from cart
    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->student_id == Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart.view')->with('success', 'Course removed from cart.');
    }
}
