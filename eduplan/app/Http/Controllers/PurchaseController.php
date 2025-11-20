<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // Delete a purchase record (remove course)
    public function destroy($courseId)
    {
        $purchase = Purchase::where('user_id', Auth::id())
                            ->where('course_id', $courseId)
                            ->first();

        if (!$purchase) {
            return redirect()->back()->with('error', 'Purchase not found.');
        }

        $purchase->delete();

        return redirect()->back()->with('success', 'Course removed successfully. You can repurchase it anytime.');
    }

    // Show all purchases
    public function index()
    {
        $purchases = Purchase::with(['user', 'course'])->latest()->get();
        return view('admin.purchases', compact('purchases'));
    }

    // // Show details of a specific purchase
    // public function show($id)
    // {
    //     $purchase = Purchase::with(['user', 'course'])->findOrFail($id);
    //     return view('admin.purchase-details', compact('purchase'));
    // }
}
