<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttestationTravail extends Model
{
    use HasFactory;
protected $table='attestation_travail';
    protected $fillable = [
        'id_user',
        'numero_cnps',
 
        'date_embauche',

        'lieu_travail',
        'type_contrat',
        'validation_directeur',
        'date_validation',
        'directeur_executif',
        'organisation',

    ];

    protected $casts = [
        'date_embauche' => 'date',
        'date_validation' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
