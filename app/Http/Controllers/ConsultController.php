<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Consult;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\patients;


class ConsultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addConsult() {
        return view('consults.addConsult');
    }

    public function addConsultAction(Request $r) {
        $data = $r->only(['cpfDoctor', 'cpfPatient', 'date', 'hour', 'description']);
        $idAccount = Auth::id();



        $validator = Validator::make($data, [
            'cpfDoctor' => ['required', 'string', 'max:14'],
            'cpfPatient' =>['required', 'string', 'max:14'],
            'date' => ['required'],
            'hour' => ['required'],
            'description' => ['required', 'string']
        ]);

        if($validator->fails()) {
            return redirect()->route('addConsult')
            ->withErrors($validator)
            ->withInput();
        }

        $cpfDoctorValidate = Doctor::where('cpf', $data['cpfDoctor'])->first();
        $cpfPatientValidate = Patient::where('cpf', $data['cpfPatient'])->first();

        $consultHourValidate = Consult::where('doctorCpf', $data['cpfDoctor'])
        ->where('date', $data['date'])
        ->where('hour', $data['hour'])->first();

        if(empty($cpfDoctorValidate)) {
            $validator->errors()->add('cpfDoctor','Não existe doutor cadastrado com esse cpf');

            return redirect()->route('addConsult')
            ->withErrors($validator)
            ->withInput();
        }

        if(empty($cpfPatientValidate)) {
            $validator->errors()->add('cpfPatient','Não existe paciente cadastrado com esse cpf');

            return redirect()->route('addConsult')
            ->withErrors($validator)
            ->withInput();
        }

        if($consultHourValidate) {
            $validator->errors()->add('hour','O médico já tem uma consulta marcada a essa hora');

            return redirect()->route('addConsult')
            ->withErrors($validator)
            ->withInput();
        }



        $consult = new Consult();
        $consult->doctorCpf = $data['cpfDoctor'];
        $consult->patientCpf = $data['cpfPatient'];
        $consult->nameDoctor = $cpfDoctorValidate['name'];
        $consult->namePatient = $cpfPatientValidate['name'];
        $consult->date = $data['date'];
        $consult->hour = $data['hour'];
        $consult->description = $data['description'];
        $consult->idAccount = $idAccount;
        $consult->save();

        return redirect()->route('addConsult')
        ->with('warning', 'Nova Cosulta marcada');
    }

    public function editConsult($id, $view) {
        $data = Consult::where('id', $id)->first();
        $dataSet = Consult::where('id', $id)->first();

        return view('consults.editConsult',
        [
            'consult' => $data,
            'dataSet' => $dataSet,
            'view' => $view
        ]);
    }

    public function editPendings() {
        $id = Auth::id();
        $data = Consult::where('idAccount', $id)
        ->where('status', 0)
        ->orderBy('hour', 'asc')
        ->paginate(10);

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

        return view('consults.pendingConsults', [
            'consults' => $data,
            'status' => $status,
        ]);
    }

    public function editConsultAction(Request $r, $id, $view) {
        $data = $r->only(['date', 'hour', 'description', 'status']);
        $dataSet = Consult::where('id', $id)->first();
        $dateActual = date('Y-m-d');

        $errors = [];

        if($dataSet['date'] != $data['date']) {
            if($data['date'] < $dateActual) {
                $errors['date'] = 'Essa data não é valida';

                return redirect()->route('editConsult', ['id' => $dataSet['id']])
                ->with($errors)
                ->withInput();
            }
        }

        if($data['description'] != $dataSet['description']) {
            if(strlen($data['description']) == 0) {
                $errors['desc'] = 'A descrição não pode ficar vazia';

                return redirect()->route('editConsult', ['id' => $dataSet['id']])
                ->with($errors)
                ->withInput();
            }
        }


        Consult::where('id', $id)
        ->update([
            'date' => $data['date'],
            'description' => $data['description'],
            'hour' => $data['hour'],
            'status' => $data['status']
        ]);

        if($view == 'pendingConsults') {
            return redirect()->route('editPendings');
        }

         if($view == 'historic') {
            return redirect()->route('historic'); 
        }

         if($view == 'home') {
            return redirect()->route('home');
        }

        return redirect()->route('editConsult', ['id' => $dataSet['id']]);
    }

    public function historic() {
        $id = Auth::id();
        $list = Consult::where('idAccount', $id)
        ->orderBy('date', 'desc')
        ->paginate(5);


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

        return view('consults.historic', [
            'consults' => $list,
            'status' => $status
        ]);
    }
}
