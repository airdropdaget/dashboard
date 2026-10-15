<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Finance Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased min-h-screen">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-950 border-r border-slate-800 flex flex-col shrink-0">
            <div class="p-6 border-b border-slate-800 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-600/30 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="font-bold text-lg text-white">Keuangan Rumah</span>
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="flex items-center space-x-3 px-4 py-3 bg-indigo-600/20 text-indigo-400 border border-indigo-500/30 rounded-xl font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-red-400 hover:bg-red-500/10 rounded-xl transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900">
            
            <!-- Header -->
            <header class="p-6 border-b border-slate-800 flex justify-between items-center bg-slate-900/50 backdrop-blur-md sticky top-0 z-10">
                <h1 class="text-xl font-bold text-white">Ringkasan Keuangan</h1>
                <span class="text-sm text-slate-400">Halo, <strong class="text-white">{{ Auth::user()->name }}</strong></span>
            </header>

            <main class="p-6 space-y-6 max-w-7xl w-full mx-auto">

                @if(session('success'))
                    <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-xl backdrop-blur-xl">
                        <span class="text-xs font-semibold uppercase text-slate-400">Total Pemasukan</span>
                        <p class="text-2xl font-bold text-emerald-400 mt-2">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-6 bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-xl backdrop-blur-xl">
                        <span class="text-xs font-semibold uppercase text-slate-400">Total Pengeluaran</span>
                        <p class="text-2xl font-bold text-rose-400 mt-2">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-6 bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-xl backdrop-blur-xl">
                        <span class="text-xs font-semibold uppercase text-slate-400">Saldo Bersih</span>
                        <p class="text-2xl font-bold text-indigo-400 mt-2">Rp {{ number_format($netBalance, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Form Input Transaksi -->
                <div class="p-6 bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-xl">
                    <h2 class="text-lg font-bold text-white mb-4 flex items-center space-x-2">
                        <span>+ Tambah Transaksi Baru</span>
                    </h2>
                    
                    <form action="{{ route('transactions.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                        @csrf
                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Jenis</label>
                            <select name="type" required class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="income">Pemasukan (+)</option>
                                <option value="expense">Pengeluaran (-)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Kategori</label>
                            <input type="text" name="category" placeholder="Gaji, Belanja, dll." required class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Jumlah (Rp)</label>
                            <input type="number" step="0.01" name="amount" placeholder="50000" required class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Tanggal</label>
                            <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs text-slate-400 mb-1">Catatan (Opsional)</label>
                            <div class="flex space-x-2">
                                <input type="text" name="description" placeholder="Keterangan transaksi" class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium rounded-xl transition shrink-0">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tabel Transaksi Terbaru -->
                <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-6 border-b border-slate-700/50">
                        <h2 class="text-lg font-bold text-white">10 Transaksi Terakhir</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-300">
                            <thead class="bg-slate-900/50 text-slate-400 uppercase text-xs">
                                <tr>
                                    <th class="p-4">Tanggal</th>
                                    <th class="p-4">Kategori</th>
                                    <th class="p-4">Catatan</th>
                                    <th class="p-4">Jenis</th>
                                    <th class="p-4 text-right">Jumlah</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/50">
                                @forelse($transactions as $t)
                                    <tr class="hover:bg-slate-800/30 transition">
                                        <td class="p-4">{{ \Carbon\Carbon::parse($t->transaction_date)->format('d M Y') }}</td>
                                        <td class="p-4 font-medium text-white">{{ $t->category }}</td>
                                        <td class="p-4 text-slate-400">{{ $t->description ?? '-' }}</td>
                                        <td class="p-4">
                                            @if($t->type === 'income')
                                                <span class="px-2.5 py-1 text-xs font-semibold bg-emerald-500/10 text-emerald-400 rounded-full border border-emerald-500/20">Pemasukan</span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-semibold bg-rose-500/10 text-rose-400 rounded-full border border-rose-500/20">Pengeluaran</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right font-bold {{ $t->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                            {{ $t->type === 'income' ? '+' : '-' }} Rp {{ number_format($t->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="p-4 text-center">
                                            <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-500 hover:text-rose-400 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-6 text-center text-slate-500">Belum ada transaksi. Tambahkan transaksi pertama Anda di atas!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>
</body>
</html>