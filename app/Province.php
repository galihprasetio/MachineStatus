<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Sofa\Eloquence\Eloquence;

class Province extends Model
{
    //
   // use Eloquence;
    use SoftDeletes;
    protected $table = 'province';
    protected $dates = ['deleted_at'];

    //protected $searchableColumns = ['province'];
}
