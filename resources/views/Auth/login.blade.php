<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Household Finance Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full flex items-center justify-center bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 font-sans antialiased">
    <div class="w-full max-w-md px-6">
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl p-8 text-white">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-600/30 border border-indigo-500/30 text-indigo-400 mb-4 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white">Keuangan Rumah</h1>
                <p class="text-sm text-slate-400 mt-1">Silakan masuk untuk mengelola keuangan</p>
            </div>

            @if($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm flex items-center space-x-2">
                    <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold tracking-wider text-slate-300 uppercase mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="fajar@finance.com"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                </div>

                <div>
                    <label class="block text-xs font-semibold tracking-wider text-slate-300 uppercase mb-2">Password</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                </div>

                <button type="submit"
                    class="w-full mt-2 py-3 px-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/25 transition duration-200 transform active:scale-[0.99]">
                    Masuk ke Dashboard
                </button>
            </form>

            <div class="mt-8 text-center text-xs text-slate-500">
                Household Finance Dashboard &copy; 2026
            </div>
        </div>
    </div>
</body>
</html>