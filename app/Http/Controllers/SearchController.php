<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consult;

class SearchController extends Controller
{
    public function searchIndex(Request $r) {
        ini_set('memory_limit','512M');

        $term = $r->input('adminlteSearch');

        $status = [
            0 => [
                'class' => 'warning',
                'status' => 'Pendente'
            ],
            1 => [
                'class' => 'success',
                'status' => 'Concluida'
            ],
            2 => [
                'class' => 'info',
                'status' => 'Faltou'
            ],
            3 => [
                'class' => 'danger',
                'status' => 'Cancelada'
            ]
        ];


        $searchResult = Consult::where('doctorCpf', $term)
        ->orwhere('patientCpf', $term)
        ->orwhere('namePatient', $term)
        ->orwhere('nameDoctor', $term)
        ->orwhere('date', $term)
        ->paginate(10);

        return view('searchPage', [
            'consults' => $searchResult,
            'status' => $status,
            'term' => $term
        ]);

    }
}
