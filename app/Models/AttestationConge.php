<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttestationConge extends Model
{
    use HasFactory;

    protected $table = 'attestations_conge';

    protected $fillable = [
        'demande_conge_id',
        'user_id',
        'date_fin_conge',
        'nombre_jours',
        'date_debut_periode',
        'date_fin_periode',
        'annee',
        'valide_directeur',
        'date_validation',
    ];

    protected $casts = [
        'date_fin_conge' => 'date',
        'date_debut_periode' => 'date',
        'date_fin_periode' => 'date',
        'date_validation' => 'datetime',
        'valide_directeur' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function demandeConge()
    {
        return $this->belongsTo(DemandeDepartConges::class, 'demande_conge_id');
    }
}
