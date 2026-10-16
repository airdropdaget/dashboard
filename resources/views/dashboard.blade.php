<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Finance Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar dengan Menu Lengkap -->
        <aside class="hidden md:flex md:w-64 bg-slate-900/80 backdrop-blur-xl border-r border-slate-800 flex-col shrink-0">
            <div class="p-6 border-b border-slate-800 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500 flex items-center justify-center text-slate-950 font-bold shadow-lg shadow-amber-500/20">KR</div>
                <span class="font-bold text-lg text-white">Catatan</span>
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-xl font-medium">
                    <span>Dashboard Utama</span>
                </a>
                <a href="{{ route('transactions.index') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-400 hover:bg-slate-800/60 rounded-xl transition">
                    <span>Data Transaksi (Paging)</span>
                </a>
                <a href="{{ route('transactions.create') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-400 hover:bg-slate-800/60 rounded-xl transition">
                    <span>+ Input Transaksi Baru</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-rose-400 hover:bg-rose-500/10 rounded-xl transition">
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto bg-slate-950">
            
            <!-- Header -->
            <header class="p-6 border-b border-slate-800 flex justify-between items-center bg-slate-950/80 backdrop-blur sticky top-0 z-10">
                <h1 class="text-xl font-bold text-white">Ringkasan Keuangan</h1>
                <span class="text-sm text-slate-400">Halo, <strong class="text-white">{{ Auth::user()->name }}</strong></span>
            </header>

            <main class="p-6 sm:p-8 space-y-6 max-w-7xl w-full mx-auto">

                @if(session('success'))
                    <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-2xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-6 bg-slate-900/60 border border-slate-800 rounded-3xl shadow-xl backdrop-blur">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Total Pemasukan</span>
                        <p class="text-3xl font-extrabold text-emerald-400 mt-2">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-6 bg-slate-900/60 border border-slate-800 rounded-3xl shadow-xl backdrop-blur">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Total Pengeluaran</span>
                        <p class="text-3xl font-extrabold text-rose-400 mt-2">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-6 bg-slate-900/60 border border-slate-800 rounded-3xl shadow-xl backdrop-blur">
                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Saldo Bersih</span>
                        <p class="text-3xl font-extrabold text-amber-400 mt-2">Rp {{ number_format($netBalance, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Form Input Singkat di Dashboard -->
                <div class="p-6 sm:p-8 bg-slate-900/60 border border-slate-800 rounded-3xl shadow-xl backdrop-blur">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-bold text-white">+ Tambah Transaksi Cepat</h2>
                        <a href="{{ route('transactions.index') }}" class="text-xs text-amber-400 hover:underline">Lihat Semua Data & Paging &rarr;</a>
                    </div>
                    
                    <form action="{{ route('transactions.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                        @csrf
                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Jenis</label>
                            <select name="type" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                                <option value="income">Pemasukan (+)</option>
                                <option value="expense">Pengeluaran (-)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Kategori</label>
                            <input type="text" name="category" placeholder="Gaji, Belanja, dll." required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Jumlah (Rp)</label>
                            <input type="number" step="0.01" name="amount" placeholder="50000" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-xs text-slate-400 mb-1">Tanggal</label>
                            <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs text-slate-400 mb-1">Catatan (Opsional)</label>
                            <div class="flex space-x-2">
                                <input type="text" name="description" placeholder="Keterangan singkat" class="w-full px-3 py-2 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                                <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-xl transition shrink-0 text-sm">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </main>
        </div>
    </div>
</body>
</html>