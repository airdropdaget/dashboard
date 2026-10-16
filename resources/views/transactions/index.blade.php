<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi - Keuangan Rumah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Navigasi -->
        <aside class="hidden md:flex md:w-64 bg-slate-900/80 backdrop-blur-xl border-r border-slate-800 flex-col shrink-0">
            <div class="p-6 border-b border-slate-800 flex items-center space-x-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500 flex items-center justify-center text-slate-950 font-bold">KR</div>
                <span class="font-bold text-lg text-white">Keuangan Rumah</span>
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
                    <span>Dashboard Utama</span>
                </a>
                <a href="{{ route('transactions.index') }}" class="flex items-center space-x-3 px-4 py-3 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-xl font-medium">
                    <span>Data Transaksi</span>
                </a>
                <a href="{{ route('transactions.create') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-400 hover:bg-slate-800 rounded-xl transition">
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
            <header class="p-6 border-b border-slate-800 flex justify-between items-center bg-slate-950/80 backdrop-blur sticky top-0 z-10">
                <h1 class="text-xl font-bold text-white">Kelola Data Transaksi</h1>
                <a href="{{ route('transactions.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-xl text-sm transition shadow-lg shadow-amber-500/20">
                    + Tambah Transaksi
                </a>
            </header>

            <main class="p-6 sm:p-8 space-y-6 max-w-7xl w-full mx-auto">
                @if(session('success'))
                    <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-2xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabel Riwayat dengan Paging -->
                <div class="bg-slate-900/60 border border-slate-800 rounded-3xl shadow-2xl overflow-hidden backdrop-blur">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-300">
                            <thead class="bg-slate-950 text-slate-400 uppercase text-xs">
                                <tr>
                                    <th class="p-5">Tanggal</th>
                                    <th class="p-5">Kategori</th>
                                    <th class="p-5">Catatan</th>
                                    <th class="p-5">Jenis</th>
                                    <th class="p-5 text-right">Jumlah</th>
                                    <th class="p-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800">
                                @forelse($transactions as $t)
                                    <tr class="hover:bg-slate-800/40 transition">
                                        <td class="p-5">{{ \Carbon\Carbon::parse($t->transaction_date)->format('d M Y') }}</td>
                                        <td class="p-5 font-bold text-white">{{ $t->category }}</td>
                                        <td class="p-5 text-slate-400">{{ $t->description ?? '-' }}</td>
                                        <td class="p-5">
                                            @if($t->type === 'income')
                                                <span class="px-3 py-1 text-xs font-semibold bg-emerald-500/10 text-emerald-400 rounded-full border border-emerald-500/20">Pemasukan</span>
                                            @else
                                                <span class="px-3 py-1 text-xs font-semibold bg-rose-500/10 text-rose-400 rounded-full border border-rose-500/20">Pengeluaran</span>
                                            @endif
                                        </td>
                                        <td class="p-5 text-right font-bold {{ $t->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                            {{ $t->type === 'income' ? '+' : '-' }} Rp {{ number_format($t->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="p-5 text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('transactions.edit', $t->id) }}" class="px-3 py-1.5 bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 rounded-lg text-xs font-medium transition">
                                                    Edit
                                                </a>
                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1.5 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 rounded-lg text-xs font-medium transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-10 text-center text-slate-500">Belum ada data transaksi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination / Paging Links -->
                    <div class="p-5 border-t border-slate-800">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>