<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi - Keuangan Rumah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-xl bg-slate-900 border border-slate-800 p-8 rounded-3xl shadow-2xl backdrop-blur-xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-white">Edit Transaksi</h1>
            <a href="{{ route('transactions.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Kembali ke Tabel</a>
        </div>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Jenis Transaksi</label>
                <select name="type" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                    <option value="income" {{ $transaction->type === 'income' ? 'selected' : '' }}>Pemasukan (+)</option>
                    <option value="expense" {{ $transaction->type === 'expense' ? 'selected' : '' }}>Pengeluaran (-)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Kategori</label>
                <input type="text" name="category" value="{{ $transaction->category }}" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Jumlah (Rp)</label>
                <input type="number" step="0.01" name="amount" value="{{ $transaction->amount }}" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Tanggal</label>
                <input type="date" name="transaction_date" value="{{ $transaction->transaction_date }}" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Catatan (Opsional)</label>
                <input type="text" name="description" value="{{ $transaction->description }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
            </div>

            <button type="submit" class="w-full py-4 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-xl shadow-lg transition text-base">
                Perbarui Transaksi
            </button>
        </form>
    </div>

</body>
</html>