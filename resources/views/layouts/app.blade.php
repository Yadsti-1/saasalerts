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
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
        </div>
        
    </body>
    <footer class="bg-white border-gray-800 text-black mt-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold">SAS</h3>
                    <p class="text-sm">Gestión y visualización de calendarios tributarios</p>
                </div>
                <div>
                    <ul class="flex space-x-4">
                        <li><a href="#" class="text-sm hover:underline">Inicio</a></li>
                        <li><a href="#" class="text-sm hover:underline">Acerca de</a></li>
                        <li><a href="#" class="text-sm hover:underline">Contacto</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-4 text-center">
                <p class="text-sm">&copy; {{ date('Y') }} SAS. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

</html>
