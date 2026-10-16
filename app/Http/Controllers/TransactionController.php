<?php

public function index()
{
    $transactions = auth()->user()->transactions()->latest()->paginate(10); // Menggunakan Paging 10 data
    $totalIncome = auth()->user()->transactions()->where('type', 'income')->sum('amount');
    $totalExpense = auth()->user()->transactions()->where('type', 'expense')->sum('amount');
    $netBalance = $totalIncome - $totalExpense;

    return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpense', 'netBalance'));
}

public function create()
{
    return view('transactions.create');
}

public function store(Request $request)
{
    // validasi dan simpan...
    auth()->user()->transactions()->create($request->all());
    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
}

public function edit($id)
{
    $transaction = auth()->user()->transactions()->findOrFail($id);
    return view('transactions.edit', compact('transaction'));
}

public function update(Request $request, $id)
{
    $transaction = auth()->user()->transactions()->findOrFail($id);
    $transaction->update($request->all());
    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
}

public function destroy($id)
{
    $transaction = auth()->user()->transactions()->findOrFail($id);
    $transaction->delete();
    return redirect()->back()->with('success', 'Transaksi berhasil dihapus!');
}
public function edit($id)
{
    $transaction = auth()->user()->transactions()->findOrFail($id);
    return view('transactions.edit', compact('transaction'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'type' => 'required|in:income,expense',
        'category' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'transaction_date' => 'required|date',
    ]);

    $transaction = auth()->user()->transactions()->findOrFail($id);
    $transaction->update($request->all());

    return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
}