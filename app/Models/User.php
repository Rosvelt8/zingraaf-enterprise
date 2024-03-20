<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsers(){
        $currentUser= Auth()->user();

        $users=self::select('users.*','D.*', 'E.*')
        ->leftjoin('divisions AS D', 'users.division', '=', 'D.iddiv')
        ->leftjoin('enterprises AS E', 'users.enterprise', '=', 'E.ident')
        ->get();
        // request to get all users in same enterprise of user connected
        if($currentUser->division!==NULL){
            $users=self::select('users.*','D.*', 'E.*')
                    ->join('divisions AS D', 'users.division', '=', 'D.iddiv')
                    ->join('enterprises AS E', 'users.enterprise', '=', 'E.ident')
                    ->where('enterprise',$currentUser->enterprise)->get();
            
        }
        if($currentUser->enterprise!==NULL){

            $users=self::select('users.*','D.*', 'E.*')
            ->leftjoin('divisions AS D', 'users.division', '=', 'D.iddiv')
            ->join('enterprises AS E', 'users.enterprise', '=', 'E.ident')
            ->where('enterprise',"=",$currentUser->enterprise)->get();
        }

        return $users;
        
    }

    // function to get one user
    public static function getOneUser($id){
        return self::select('users.*','D.*', 'E.*')
        ->leftjoin('divisions AS D', 'users.division', '=', 'D.iddiv')
        ->leftjoin('enterprises AS E', 'users.enterprise', '=', 'E.ident')
        ->where('users.id', $id)
        ->get();
    }
}
