<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAbsence extends Model
{
    use HasFactory;
    protected $table='demandes_absence';
    protected $fillable = [
        'id_user',
        'nombre_jours',
        'date_debut',
        'date_fin',
        'objet_demande',
        'date_creation',
        'id_superieur',
        'validation_superieur',
        'signature_demandeur',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_creation' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
