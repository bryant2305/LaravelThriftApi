<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Exceptions\NotPermissions;


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


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }

    public function scopeName($query, $name = null, $paginacion = null)
    {
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query->paginate($paginacion ?? env('PAGINAR'));
    }

    public function hasPermiso($permiso)
    {
        $user = auth()->user();

        if ($user) {
            $roles = $user->roles;

            foreach ($roles as $role) {
                $permisos = $role->permisos;

                foreach ($permisos as $item) {
                    if ($item->nombre == $permiso) {
                        return true;
                    }
                }
            }
        }

        throw new NotPermissions();
    }



}
