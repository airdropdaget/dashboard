<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Administrasi Utama</title>
    <!-- Menggunakan Tailwind CSS (via Vite/CDN) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 font-sans antialiased selection:bg-amber-200">

    <!-- Latar Belakang Dekoratif (Megah) -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-1/2 -right-1/2 w-[100rem] h-[100rem] rounded-full bg-amber-50/50 border-4 border-dashed border-amber-100"></div>
        <div class="absolute -bottom-1/2 -left-1/2 w-[80rem] h-[80rem] rounded-full bg-slate-100/70"></div>
    </div>

    <div class="w-full max-w-lg flex flex-col md:flex-row shadow-2xl rounded-3xl overflow-hidden bg-white border border-slate-100">
        
        <!-- Bagian Kiri: Branding / Gambar Ilustrasi -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-t from-amber-900 to-yellow-700 p-10 text-amber-50 flex-col justify-between relative overflow-hidden">
            
            <!-- Efek Pattern / Cahaya -->
            <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48ZyBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMSI+PHBhdGggZD0iTTAgMGg0MHY0MEgwVjB6bTIwIDIwaDIwdjIwSDIWMjB6TTAgMjBoMjB2MjBIMFYyMHoyMCAwaDIwdjIwSDIwVjB6Ii8+PC9nPjwvZz48L3N2Zz4=')]"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="bg-amber-400 p-3 rounded-xl shadow-lg">
                        <svg class="w-7 h-7 text-amber-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight">Sistem Keamanan</h2>
                </div>
                <h1 class="text-4xl font-extrabold tracking-tighter leading-tight mb-4 text-white">Akses Terkendali,<br>Hasil Maksimal.</h1>
                <p class="text-amber-200 text-base font-light max-w-sm leading-relaxed opacity-90">Masuk untuk mengelola data, memantau kinerja, dan mengambil keputusan strategis dengan cepat dan akurat.</p>
            </div>
            
            <div class="relative z-10 border-t border-amber-800/50 pt-6 mt-10">
                <p class="text-amber-300 text-sm">&copy; {{ date('Y') }} - Solusi Perangkat Lunak Terintegrasi</p>
            </div>
        </div>

        <!-- Bagian Kanan: Form Login -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
            
            <!-- Header Logo / Title (Mobile View) -->
            <div class="text-center mb-8 md:hidden">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-400/20 border border-amber-200 mb-4">
                    <svg class="w-8 h-8 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-950 tracking-tighter">Selamat Datang Kembali</h1>
                <p class="text-slate-500 text-sm mt-2">Silakan masukkan kredensial Anda untuk melanjutkan</p>
            </div>

            <!-- Pesan Error / Status -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm animate-pulse">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Input Email / Username -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">Email atau Nama Pengguna</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-100 border border-slate-200 text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all shadow-inner"
                            placeholder="admin@kantor.com">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </span>
                        <input type="password" name="password" required
                            class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-100 border border-slate-200 text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all shadow-inner"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-sm text-slate-600">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-amber-600 focus:ring-amber-500">
                        <span>Ingat saya</span>
                    </label>
                    <!-- Opsional: Link Lupa Password -->
                    {{-- <a href="#" class="text-amber-700 hover:text-amber-600 font-medium">Lupa kata sandi?</a> --}}
                </div>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="w-full py-4 px-6 bg-gradient-to-r from-yellow-600 to-amber-600 hover:from-yellow-500 hover:to-amber-500 text-white font-bold rounded-2xl shadow-xl shadow-yellow-600/30 focus:outline-none focus:ring-4 focus:ring-amber-300 transition-all transform active:scale-[0.99] text-lg">
                    Masuk ke Sistem
                </button>
            </form>

            <!-- Footer Note (Mobile) -->
            <p class="text-center text-slate-400 text-xs mt-10 md:hidden">
                &copy; {{ date('Y') }} - Solusi Perangkat Lunak Terintegrasi.
            </p>
        </div>
    </div>

</body>
</html>