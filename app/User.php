<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','created_by','updated_by','profile','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

    public static function get_users()
    {
        // for custom query use below query
        /* $data = DB::select( DB::raw("SELECT users.*,CONCAT_WS(' ',users.name,users.email) AS name FROM users
    ") ); */
        return DB::table('users')
            ->select('users.*', 'roles.name as role_name')
            ->latest()
            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
            ->get();
    }
}
