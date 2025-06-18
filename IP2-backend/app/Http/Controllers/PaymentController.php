<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::with(['order', 'user'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'user_id' => 'required|exists:users,user_id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,mobile',
            'transaction_id' => 'nullable|string'
        ]);

        $payment = Payment::create([
            'order_id' => $validated['order_id'],
            'user_id' => $validated['user_id'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'paid',
            'transaction_id' => $validated['transaction_id'] ?? null,
            'payment_date' => now()
        ]);

        return response()->json($payment, 201);
    }

    public function show(Payment $payment)
    {
        return response()->json($payment->load(['order', 'user']));
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,fail,refund'
        ]);

        $payment->update(['payment_status' => $validated['payment_status']]);
        return response()->json($payment);
    }
}