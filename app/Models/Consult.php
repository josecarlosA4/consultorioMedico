<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    use HasFactory;

    protected $table = 'consults';

    protected $fillable = [
        'doctorCpf',
        'patientCpf',
        'hour',
        'date',
        'description',
        'status',
        'idAccount'
    ];

    public $timestamps = false;
}
