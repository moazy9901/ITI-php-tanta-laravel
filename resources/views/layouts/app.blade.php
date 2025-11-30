<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow flex px-20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 w-1/2 flex justify-start items-center">
                        {{ $header }}
                    </div>
                     <!-- Add Product Button -->
                     <div class=" w-1/2 flex justify-end items-center">
                        @can('create-product')
                        <a href="{{ route('products.create') }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Add Product
                    </a>
                    @endcan
                    </div>
                </header>
            @endisset


            <!-- Page Content -->
            <main>
                {{ $slot }}
                 {{-- notification  --}}
            @if (session('success'))
            <div id="toast-success"
                class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 {{ session('type') === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}
   rounded-lg shadow">
                <span class="ml-3 text-sm font-medium">{{ session('success') }}</span>
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('toast-success').style.display = 'none';
                }, 3000);
            </script>
            @endif
            </main>
        </div>

    </body>
</html>
