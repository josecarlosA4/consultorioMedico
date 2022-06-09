<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Teste;
use App\Models\Doctor;



class TesteController extends Controller
{
    public function index() {
        return view('teste');
    }

    public function indexAction(Request $r) {
        $data = $r->only(['name','cpf', 'birthdate', 'email']);
        $idAccount = Auth::id();

        $validator = Validator::make($data, [
            'name' => ['required', 'string'],
            'cpf' => ['required', 'string', 'unique:doctors'],
            'email' => ['required', 'email', 'unique:doctors'],
            'birthdate' => ['required']
        ]);

        if($validator->fails()) {
            return redirect()->route('teste')
            ->withErrors($validator)
            ->withInput();
        }

        $t = new Doctor();
        $t->name = $data['name'];
        $t->cpf = $data['cpf'];
        $t->birthdate = $data['birthdate'];
        $t->email = $data['email'];
        $t->idAccount = $idAccount;
        $t->save();


        return redirect()->route('teste');
    }
}
