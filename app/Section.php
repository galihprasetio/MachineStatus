<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Section extends Model
{
    //
    use SoftDeletes;
    protected $table = 'section';
    protected $fillable = ['section'];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function Department(){
        return $this->belongsTo('App\Department');
    }
}
