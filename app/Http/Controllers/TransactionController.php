<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'             => 'required|in:income,expense',
            'category'         => 'required|string|max:100',
            'amount'           => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'description'      => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        Transaction::create($validated);

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function destroy(Transaction $transaction)
    {
        // Pastikan pengguna hanya bisa menghapus transaksinya sendiri
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus!');
    }
}