<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdreMission extends Model
{
    use HasFactory;
protected $table="ordres_mission";
    protected $fillable = [
        'user_id',
        'emploi_occupe',
        'lieu_mission',
        'objet_mission',
        'moyen_transport',
        'date_depart',
        'date_retour',
        'lieu_creation',
        'date_creation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
