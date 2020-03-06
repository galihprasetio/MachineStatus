<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceHistory extends Model
{
    //
    protected $table = 'device_history';
    protected $fillable = [
        'id_device',
        'id_machine',
        'action_by',
        'remark',
    ];
}
