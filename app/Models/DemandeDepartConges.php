<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeDepartConges extends Model
{
    use HasFactory;
    protected $table='demandes_depart_conges';

    protected $fillable = [
        'id_user',
 
        'service_secteur',
        'motif',
        'date_debut',
        'date_fin',
        'nombre_jours_ouvrables',
        'nombre_jours_calendaires',
        'adresse_sejour',
        'nom_interimaire',
        'qualification_interimaire',
        'fonction_interimaire',
        'signature_demandeur',
        'avis_superieur',
        'id_superieur',
        'date_validation',
        'date_creation',
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
