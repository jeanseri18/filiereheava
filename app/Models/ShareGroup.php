<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];
    public function members()
    {
        return $this->belongsToMany(User::class, 'share_lists', 'id_group', 'id_user')->withTimestamps();
    }
}

