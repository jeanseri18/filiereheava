<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'id_document',
        'id_user',
        'action_date',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'id_document');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
   
    public function getStatusClassAttribute()
    {
        return match ($this->status) {
            'terminé' => 'success',
            'en cours' => 'warning',
            'complété' => 'primary',
            'erreur' => 'danger',
            default => 'secondary',
        };
    }
}
 
