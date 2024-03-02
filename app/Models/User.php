<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Flasher\Laravel\Http\Request;
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
        'password' => 'hashed',
    ];

    static public function getAdmin()
    {
        $return = self::select('users.*')
                        ->where('user_type', 1)
                        ->where('is_delete', 0);
                        if (!empty(request('email'))) {
                            $email = request('email');
                            $return = $return ->where('email', 'like', '%'.$email.'%');
                        }
                        if (!empty(request('name'))) {
                            $name = request('name');
                            $return = $return ->where('name', 'like', '%'.$name.'%');
                        }
                        if (!empty(request('date'))) {
                            $date = request('date');
                            $return = $return ->whereDate('created_at', $date);
                        }
        $return  = $return->orderBy('id', 'desc')
                          ->paginate(20);
        return $return;
    }

    static public  function getEmailSingle($email)
    {
        return self::where('email', $email)->first();
    }

    static public  function getTokenSingle($remember_token)
    {
        return self::where('remember_token', $remember_token)->first();
    }
}
