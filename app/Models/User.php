<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'nom',
        'email',
        'password',
        'role',
        'id_service',
        'is_validator',
        'status',
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
     // Relation avec le service
     public function service()
     {
         return $this->belongsTo(Service::class, 'id_service');
     }
     public function shareGroups()
{
    return $this->belongsToMany(ShareGroup::class, 'share_lists', 'id_user', 'id_group')->withTimestamps();
}

}
