<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $table = 'device';
    protected $fillable = [
        'id_machine',
        'device_type',
        'model_type',
        'detail_type',
        'device_status',
        'monitor',
        'device_status_monitor',
        'remark',
        'updated_by',
    ];
}
