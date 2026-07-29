<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased h-screen overflow-hidden">

    <div class="flex h-screen w-full">
        <!-- Left Banner (Branding) -->
        <div class="hidden lg:flex w-[55%] bg-blue-900 flex-col justify-between p-16 relative overflow-hidden">

            <!-- Animated / Abstract Shapes using plain divs -->
            <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-blue-600 rounded-full mix-blend-multiply opacity-50 blur-[80px]"></div>
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-indigo-500 rounded-full mix-blend-multiply opacity-40 blur-[100px]"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-10">
                    <img src="{{ asset('assets/logo.png') }}" class="h-12 w-auto bg-white p-1 rounded-lg shadow-xl" alt="Logo">
                    <span class="text-3xl font-extrabold tracking-tight text-white">Trisurya<span class="text-blue-300">Solusindo</span></span>
                </div>
            </div>

            <div class="relative z-10 mb-32 text-white">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight tracking-tight">Enterprise<br>Resource Planning<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-teal-200">Modernization.</span></h1>
                <p class="text-lg text-blue-100 max-w-lg leading-relaxed font-light">

                </p>
            </div>

            <div class="relative z-10">
                <p class="text-blue-200/60 text-sm font-medium">© {{ date('Y') }} PT. Trisurya Solusindo. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Content (Form) -->
        <div class="w-full lg:w-[45%] flex items-center justify-center p-8 sm:p-16 bg-white overflow-y-auto z-10 shadow-2xl relative">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="flex items-center gap-3 mb-12 lg:hidden justify-center">
                    <img src="{{ asset('assets/logo.png') }}" class="h-12 w-auto bg-white p-1 rounded-lg shadow-md" alt="Logo">
                    <span class="text-3xl font-extrabold tracking-tight text-gray-900">Trisurya<span class="text-blue-600">Solusindo</span></span>
                </div>

                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-gray-900 mb-3 tracking-tight">Selamat Datang
                    </h2>
                    <p class="text-gray-500 font-medium">Masuk ke akun Anda untuk mengelola sistem.</p>
                </div>

                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl mb-6 shadow-sm">
                    <ul class="list-disc pl-5 text-sm font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                        <input type="text" name="username" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-medium text-gray-900 outline-none" placeholder="Masukkan username" required autofocus>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-bold text-gray-700">Password</label>
                            <a href="#" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">Lupa sandi?</a>
                        </div>
                        <input type="password" name="password" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all font-medium text-gray-900 outline-none" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-4 px-4 mt-2 border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all transform hover:-translate-y-0.5">
                        Masuk ke Sistem Utama
                    </button>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500 font-medium">
                    Kendala akses? <a href="#" class="text-blue-600 hover:text-blue-800 font-bold transition-colors">Hubungi Administrator IT</a>.
                </p>
            </div>
        </div>
    </div>

</body>
</html>
