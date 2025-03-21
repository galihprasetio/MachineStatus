<?php


namespace App;


use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'id_department',
        'tittle',
        'position',
        'dateofbirth',
        'office_phone',
        'cell_phone',
        'region',
        'job_description',
       
    ];
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function getImageAttribute(){
    //     return $this->image;
    // }
    // Fetch employee by department id
    
}
