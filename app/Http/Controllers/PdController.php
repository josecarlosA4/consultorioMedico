<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Models\Patient;
use App\Models\Consult;


class PdController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addDoctor() {
        return view('pd.doctorAddView');
    }

    public function addDoctorAction(Request $r) {
        $data = $r->only(['name','cpf', 'birthdate', 'email']);
        $idAccount = Auth::id();

        $validator = Validator::make($data, [
            'name' => ['required', 'string'],
            'cpf' => ['required', 'string', 'unique:doctors'],
            'email' => ['required', 'email', 'unique:doctors'],
            'birthdate' => ['required']
        ]);

        if($validator->fails()) {
            return redirect()->route('addDoctor')
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


        return redirect()->route('addDoctor')
        ->with('warning', 'Novo Doutor adicionado com sucesso');;
    }

    public function addPatient() {
        return view('pd.patientAddView');
    }

    public function addPatientAction(Request $r) {
        $data = $r->only(['name','cpf', 'birthdate', 'email']);
        $idAccount = Auth::id();

        $validator = Validator::make($data, [
            'name' => ['required', 'string'],
            'cpf' => ['required', 'string', 'unique:patients'],
            'email' => ['required', 'email', 'unique:patients'],
            'birthdate' => ['required']
        ]);

        if($validator->fails()) {
            return redirect()->route('addPatient')
            ->withErrors($validator)
            ->withInput();
        }

        $t = new Patient();
        $t->name = $data['name'];
        $t->cpf = $data['cpf'];
        $t->birthdate = $data['birthdate'];
        $t->email = $data['email'];
        $t->idAccount = $idAccount;
        $t->save();


        return redirect()->route('addPatient')
        ->with('warning', 'Novo Paciente adicionado com sucesso');
    }

    public function doctorList() {
        $id = Auth::id();

        $list = Doctor::where('idAccount', $id)
        ->paginate(10);

        return view('pd.doctorList', [
            'doctors' => $list
        ]);
    }

    public function patientsList() {
        $id = Auth::id();

        $list = Patient::where('idAccount', $id)
        ->paginate(10);

        return view('pd.patientList', [
            'patients' => $list
        ]);

    }

    public function doctorProfile($id) {
        $data = Doctor::where('id', $id)->first();
        $doctorConsults = Consult::where('doctorCpf', $data['cpf'])->paginate(10);

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


        if($data) {
            return view('pd.doctorProfile',[
                'doctor' => $data,
                'consults' => $doctorConsults,
                'id' => $id,
                'status' => $status
            ]);
        } else {
            return redirect()->route('doctorList');
        }
    }

    public function patientProfile($id) {
        $data = Patient::find($id);
        $patientConsults = Consult::where('patientCpf', $data['cpf'])->get();

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


        if($data) {
            return view('pd.patientProfile',[
                'patient' => $data,
                'consults' => $patientConsults,
                'id' => $id,
                'status' => $status
            ]);
        } else {
            return redirect()->route('patientList');
        }
    }
}
