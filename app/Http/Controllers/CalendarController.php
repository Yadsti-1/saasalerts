<?php

namespace App\Http\Controllers;

use App\Models\Calendar; // Asegúrate de usar el modelo correcto
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
       // Obtener todos los registros del calendario
       $calendars = Calendar::all()->sortByDesc('year');

       // Obtener el año seleccionado desde el filtro, si no hay uno, se selecciona el más actual
       $selectedYear = $request->get('year', $calendars->first()->year ?? null);

       // Filtrar calendarios por el año seleccionado
       $filteredCalendars = $calendars->where('year', $selectedYear);

       return view('calendars.index', compact('filteredCalendars', 'selectedYear', 'calendars'));
    }
}
