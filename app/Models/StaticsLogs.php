<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticsLogs extends Model
{
    protected $table='statics_logs';

    protected $fillable = [
        'status'
    ];

    use HasFactory;
}
