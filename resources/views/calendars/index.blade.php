<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendario de tributario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($calendars->isNotEmpty())
                        <form method="GET" action="{{ route('calendars.index') }}">
                            <label for="year" class="block mb-2">Selecciona el año:</label>
                            <select name="year" id="year" onchange="this.form.submit()">
                                @foreach ($calendars->unique('year') as $calendar)
                                    <option value="{{ $calendar->year }}" {{ $calendar->year == $selectedYear ? 'selected' : '' }}>
                                        {{ $calendar->year }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <h3 class="text-lg font-semibold">Calendario Tributario - {{ $selectedYear }}</h3>
                        @php
                            $currentCalendar = $calendars->firstWhere('year', $selectedYear);
                        @endphp

                        @if ($currentCalendar)
                            <iframe src="{{ asset('storage/' . $currentCalendar->file_path) }}" width="100%" height="600px">
                                Este navegador no soporta PDF. Por favor descarga el PDF <a href="{{ asset('storage/' . $currentCalendar->file_path) }}">aquí</a>.
                            </iframe>
                        @else
                            <p>No hay calendario disponible para el año seleccionado.</p>
                        @endif
                    @else
                        <p>No hay calendarios disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
