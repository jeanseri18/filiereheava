<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'id_user', // L'utilisateur qui a créé le groupe
    ];

    /**
     * Relation : Créateur du groupe
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relation : Membres du groupe
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'share_lists', 'id_group', 'id_user')->withTimestamps();
    }

    
    
}

