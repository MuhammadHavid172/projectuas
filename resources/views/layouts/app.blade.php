<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Link Google Fonts untuk Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Menggunakan font Poppins di seluruh halaman */
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-white text-3xl font-bold">ProposalApp</a>
            <div class="space-x-6 hidden md:flex">
                <a href="{{ url('/') }}" class="text-white hover:text-gray-200 transition duration-300">Home</a>
                <a href="{{ url('/about') }}" class="text-white hover:text-gray-200 transition duration-300">About</a>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative">
                        <button id="userMenuBtn" class="text-white hover:text-gray-200 focus:outline-none transition duration-300">
                            {{ auth()->user()->name }}
                        </button>
                        <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden">
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">Logout</a>
                        </div>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-200 transition duration-300">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto flex-grow p-6">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        <p>&copy; 2024 ProposalApp. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript untuk menangani dropdown
        document.getElementById('userMenuBtn').addEventListener('click', function () {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
