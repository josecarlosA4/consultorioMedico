<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Consult;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $idAccount = Auth::id();
        $dataAtual = date('Y-m-d');
        $consults = Consult::where('idAccount', $idAccount)
        ->where('date', $dataAtual)
        ->orderBy('status', 'asc')
        ->paginate(10);

        $pendingConsults = Consult::where('idAccount', $idAccount)
        ->where('date', '<', $dataAtual)
        ->where('status', 0)
        ->get();

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
            ],
        ];

        if(count($pendingConsults) > 0) {
            $pending = 'Existem consultas pendentes com a data vencida. Deseja edita-las ?';
        }else {
            $pending = null;
        }

        return view('home',[
            'consults' => $consults,
            'status' => $status,
            'pending' => $pending
        ]);
        
    }
}
