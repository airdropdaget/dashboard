<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Finance Dashboard - Megah & Responsif</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen selection:bg-amber-500 selection:text-slate-950">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar (Hidden di Mobile, Muncul di MD ke atas) -->
        <aside class="hidden md:flex md:w-64 bg-slate-900/80 backdrop-blur-xl border-r border-slate-800/80 flex-col shrink-0">
            <div class="p-6 border-b border-slate-800/80 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-slate-950 shadow-lg shadow-amber-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="font-bold text-lg tracking-wide text-white">Keuangan Rumah</span>
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="flex items-center space-x-3 px-4 py-3 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-xl font-medium shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800/80">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-rose-400 hover:bg-rose-500/10 rounded-xl transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950">
            
            <!-- Header -->
            <header class="p-6 border-b border-slate-800/80 flex justify-between items-center bg-slate-950/60 backdrop-blur-md sticky top-0 z-20">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 md:hidden">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h1 class="text-xl font-extrabold text-white tracking-wide">Ringkasan Keuangan</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-400 hidden sm:inline">Halo, <strong class="text-white">{{ Auth::user()->name }}</strong></span>
                    <form method="POST" action="{{ route('logout') }}" class="md:hidden">
                        @csrf
                        <button type="submit" class="p-2 text-rose-400 hover:bg-rose-500/10 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </header>

            <main class="p-4 sm:p-8 space-y-8 max-w-7xl w-full mx-auto">

                @if(session('success'))
                    <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-2xl text-sm shadow-lg animate-pulse">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Summary Cards (Megah & Responsive) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-6 bg-slate-900/60 border border-slate-800 rounded-3xl shadow-2xl backdrop-blur-xl relative overflow-hidden group hover:border-emerald-500/50 transition duration-300">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition"></div>
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Total Pemasukan</span>
                        <p class="text-3xl font-extrabold text-emerald-400 mt-3">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                    </div>

                    <div class="p-6 bg-slate-900/60 border border-slate-800 rounded-3xl shadow-2xl backdrop-blur-xl relative overflow-hidden group hover:border-rose-500/50 transition duration-300">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-rose-500/5 rounded-full blur-2xl group-hover:bg-rose-500/10 transition"></div>
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Total Pengeluaran</span>
                        <p class="text-3xl font-extrabold text-rose-400 mt-3">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                    </div>

                    <div class="p-6 bg-slate-900/60 border border-slate-800 rounded-3xl shadow-2xl backdrop-blur-xl relative overflow-hidden group hover:border-amber-500/50 transition duration-300">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-amber-500/5 rounded-full blur-2xl group-hover:bg-amber-500/10 transition"></div>
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Saldo Bersih</span>
                        <p class="text-3xl font-extrabold text-amber-400 mt-3">Rp {{ number_format($netBalance, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Form Input Transaksi Baru -->
                <div class="p-6 sm:p-8 bg-slate-900/60 border border-slate-800 rounded-3xl shadow-2xl backdrop-blur-xl">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center space-x-2">
                        <span class="text-amber-400">+</span> <span>Tambah Transaksi Baru</span>
                    </h2>
                    
                    <form action="{{ route('transactions.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-5">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Jenis</label>
                            <select name="type" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 text-white transition">
                                <option value="income">Pemasukan (+)</option>
                                <option value="expense">Pengeluaran (-)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Kategori</label>
                            <input type="text" name="category" placeholder="Gaji, Belanja, dll." required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 text-white transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Jumlah (Rp)</label>
                            <input type="number" step="0.01" name="amount" placeholder="50000" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 text-white transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Tanggal</label>
                            <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 text-white transition">
                        </div>

                        <div class="sm:col-span-2 lg:col-span-2">
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Catatan (Opsional)</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <input type="text" name="description" placeholder="Keterangan singkat..." class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 text-white transition">
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-500 hover:to-yellow-500 text-slate-950 font-bold rounded-xl transition shadow-lg shadow-amber-600/20 shrink-0">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tabel Transaksi Terbaru dengan Tombol Edit & Hapus -->
                <div class="bg-slate-900/60 border border-slate-800 rounded-3xl shadow-2xl overflow-hidden backdrop-blur-xl">
                    <div class="p-6 sm:p-8 border-b border-slate-800 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white">10 Transaksi Terakhir</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-300">
                            <thead class="bg-slate-950/60 text-slate-400 uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="p-5">Tanggal</th>
                                    <th class="p-5">Kategori</th>
                                    <th class="p-5">Catatan</th>
                                    <th class="p-5">Jenis</th>
                                    <th class="p-5 text-right">Jumlah</th>
                                    <th class="p-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/60">
                                @forelse($transactions as $t)
                                    <tr class="hover:bg-slate-800/30 transition duration-150">
                                        <td class="p-5 font-medium whitespace-nowrap">{{ \Carbon\Carbon::parse($t->transaction_date)->format('d M Y') }}</td>
                                        <td class="p-5 font-bold text-white">{{ $t->category }}</td>
                                        <td class="p-5 text-slate-400 max-w-xs truncate">{{ $t->description ?? '-' }}</td>
                                        <td class="p-5 whitespace-nowrap">
                                            @if($t->type === 'income')
                                                <span class="px-3 py-1 text-xs font-semibold bg-emerald-500/10 text-emerald-400 rounded-full border border-emerald-500/20">Pemasukan</span>
                                            @else
                                                <span class="px-3 py-1 text-xs font-semibold bg-rose-500/10 text-rose-400 rounded-full border border-rose-500/20">Pengeluaran</span>
                                            @endif
                                        </td>
                                        <td class="p-5 text-right font-extrabold whitespace-nowrap {{ $t->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                            {{ $t->type === 'income' ? '+' : '-' }} Rp {{ number_format($t->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="p-5 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center space-x-3">
                                                <!-- Tombol Edit (Mengarahkan ke halaman/modal edit, pastikan route transactions.edit sudah ada) -->
                                                <a href="{{ route('transactions.edit', $t->id) }}" class="px-3 py-1.5 bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 border border-amber-500/20 rounded-lg text-xs font-medium transition">
                                                    Edit
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1.5 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20 rounded-lg text-xs font-medium transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-10 text-center text-slate-500">
                                            Belum ada data transaksi. Silakan tambahkan transaksi baru melalui form di atas.
                                        </td>
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