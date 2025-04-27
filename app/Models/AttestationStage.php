<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttestationStage extends Model
{
    use HasFactory;
    protected $table = 'attestations_stage';  // Assurez-vous que le nom de la table est correct

    protected $fillable = [
        'id_user',
        'duree_stage',
        'secteur',
        'date_debut',
        'date_fin',
        'lieu',
        'type_contrat',
        'validation_directeur',
        'date_validation',
     
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_validation' => 'date',
        'validation_directeur' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
