<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/teste', [TesteController::class, 'index'])->name("teste");
Route::post('/teste', [TesteController::class, 'indexAction'])->name("testeAction");


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'create']);

Route::get('/addConsult', [ConsultController::class, 'addConsult'])->name('addConsult');
Route::post('/addConsult', [ConsultController::class, 'addConsultAction'])->name('addConsultAction');
Route::get('/editConsult/{id}/{view}', [ConsultController::class, 'editConsult'])->name('editConsult');
Route::put('/editConsult/{id}/{view}', [ConsultController::class, 'editConsultAction'])->name('editConsultAction');
Route::get('/editPendings', [ConsultController::class, 'editPendings'])->name('editPendings');
Route::get('/historic', [ConsultController::class, 'historic'])->name('historic');

Route::get('/doctorsList', [PdController::class, 'doctorList'])->name('doctorList');
Route::get('/patientsList', [PdController::class, 'patientsList'])->name('patientsList');
Route::get('/doctorProfile/{id}', [PdController::class, 'doctorProfile'])->name('doctorProfile');
Route::get('/patientProfile/{id}', [PdController::class, 'patientProfile'])->name('patientProfile');
Route::get('/addDoctor', [PdController::class, 'addDoctor'])->name('addDoctor');
Route::post('/addDoctor', [PdController::class, 'addDoctorAction'])->name('addDoctorAction');
Route::get('/addPatient', [PdController::class, 'addPatient'])->name('addPatient');
Route::post('/addPatient', [PdController::class, 'addPatientAction'])->name('addPatientAction');

Route::put('/avatarDoctor/{id}', [UploadController::class, 'avatarDoctor'])->name('avatarDoctor');

Route::get('/search', [SearchController::class, 'searchIndex'])->name('search');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
