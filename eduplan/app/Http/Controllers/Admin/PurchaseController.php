<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboards.admin.purchases', compact('purchases'));
    }
}
