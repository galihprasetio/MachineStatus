<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    //
    protected $table = 'machine';
    protected $fillable = [
        'area',
        'machine_number',
    ];
}
