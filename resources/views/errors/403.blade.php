@php
    $slot = $slot ?? '';
@endphp

@component('layouts.guest', ['slot' => $slot])
    <div class="min-h-full flex items-center justify-center bg-gray-50 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    403 | Acceso denegado
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    No cuentas con permisos para acceder a esta página.
                </p>
                <a href="{{ route('dashboard') }}" class="mt-4 block w-full text-center bg-blue-600 text-white font-bold py-2 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                    Regresar
                </a>
            </div>
        </div>
    </div>
@endcomponent
