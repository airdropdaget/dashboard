<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi - Keuangan Rumah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen">

    <div class="flex flex-col md:flex-row min-h-screen">
        
        <!-- Sidebar / Menu Navigasi -->
        <aside class="w-full md:w-64 bg-slate-900 border-b md:border-b-0 md:border-r border-slate-800 flex flex-col shrink-0">
            <div class="p-6 border-b border-slate-800 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500 flex items-center justify-center text-slate-950 font-bold shadow-lg">KR</div>
                <span class="font-bold text-lg text-white">Keuangan Rumah</span>
            </div>
            
            <nav class="p-4 flex md:flex-col flex-wrap gap-2">
                <a href="{{ route('dashboard') }}" class="flex-1 md:flex-none flex items-center space-x-3 px-4 py-3 text-slate-300 hover:bg-slate-800 rounded-xl transition text-sm">
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('transactions.index') }}" class="flex-1 md:flex-none flex items-center space-x-3 px-4 py-3 text-slate-300 hover:bg-slate-800 rounded-xl transition text-sm">
                    <span>Data & Paging</span>
                </a>
                <a href="{{ route('transactions.create') }}" class="flex-1 md:flex-none flex items-center space-x-3 px-4 py-3 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-xl font-medium text-sm">
                    <span>+ Input Transaksi</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800 hidden md:block mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-3 text-rose-400 hover:bg-rose-500/10 rounded-xl transition text-sm">
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto bg-slate-950">
            <header class="p-6 border-b border-slate-800 flex justify-between items-center bg-slate-950/80 backdrop-blur sticky top-0 z-10">
                <h1 class="text-xl font-bold text-white">Form Input Transaksi Baru</h1>
                <span class="text-sm text-slate-400">Halo, <strong class="text-white">{{ Auth::user()->name }}</strong></span>
            </header>

            <main class="p-6 sm:p-8 max-w-2xl w-full mx-auto">
                <div class="bg-slate-900/60 border border-slate-800 p-8 rounded-3xl shadow-2xl backdrop-blur">
                    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Jenis Transaksi</label>
                            <select name="type" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                                <option value="income">Pemasukan (+)</option>
                                <option value="expense">Pengeluaran (-)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Kategori</label>
                            <input type="text" name="category" placeholder="Contoh: Gaji, Belanja Bulanan" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Jumlah (Rp)</label>
                            <input type="number" step="0.01" name="amount" placeholder="150000" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Tanggal</label>
                            <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Catatan (Opsional)</label>
                            <input type="text" name="description" placeholder="Keterangan tambahan..." class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:ring-2 focus:ring-amber-500">
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full py-4 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-xl shadow-lg transition text-base">
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>