<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id', 'name', 'email', 'password',];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = ['email_verified_at' => 'datetime',];

    public function setPasswordAttribute($value) : void {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getUsualyName() : string {
        $array_name = explode(" ", $this->attributes['name']);
        $name = $array_name[0]." ".$array_name[count($array_name)-1];
        return ucwords($name);
    }
    
    /* -------------------------------- Relations ------------------------------- */
    
    public function endereco() {
        return $this->hasMany(Endereco::class, "id_usuario", "id");
    }

    public function contato() {
        return $this->hasMany(Contato::class, "id_usuario", "id");
    }

    public function usuarioEmpresas() {
        return $this->hasMany(UsuarioEmpresa::class, 'id_usuario', 'id');
    }
}
