<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Department extends Model
{
    //
    use SoftDeletes;
    protected $table = 'department';
    protected $fillable = ['department'];
    protected $dates = ['deleted_at'];
    /**
 * Get the value of the model's route key.
 *
 * @return mixed
 */
    public function getRouteKey()
    {
        $hashids = new \Hashids\Hashids('MySecretSalt');

        return $hashids->encode($this->getKey());
    }
}
