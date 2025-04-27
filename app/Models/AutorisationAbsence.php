<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutorisationAbsence extends Model
{
    use HasFactory;
    protected $table =  'autorisations_absence';
    protected $fillable = [
        'id_user',
   
        'date_debut',
        'date_fin',
        'nombre_jours',
        'raison',
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
