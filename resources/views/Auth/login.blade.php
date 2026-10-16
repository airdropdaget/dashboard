<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Household Finance Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center font-sans antialiased text-slate-100">
    <div class="w-full max-w-md p-8 bg-slate-900 border border-slate-800 rounded-2xl shadow-xl">
        
        <!-- Header Judul -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold tracking-tight text-white">Keuangan Keluarga</h2>
            <p class="text-sm text-slate-400 mt-1">Silakan masuk untuk melanjutkan</p>
        </div>

        <!-- Pesan Error / Status -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded-xl">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form Login (Hanya Username & Password) -->
        <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label for="username" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                    class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200"
                    placeholder="Masukkan username">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200"
                    placeholder="••••••••">
            </div>

            <button type="submit" 
                class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-lg shadow-indigo-600/20 transition duration-200">
                Masuk
            </button>
        </form>

    </div>
</body>
</html>