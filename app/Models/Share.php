<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $table = 'shares'; // Nom de la table, si nécessaire
    protected $fillable = [
        'id_user',   // L'utilisateur auquel le document est partagé
        'id_document', // Le document partagé
        'id_group',  // Le groupe auquel le document est partagé (ajouté ici)
        'type_share', // Le type de partage (utilisateur, groupe, public, privé)
    ];
    // Définir les relations si elles existent
    public function document()
    {
        return $this->belongsTo(Document::class, 'id_document');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function group()
    {
        return $this->belongsTo(ShareGroup::class, 'id_group');
    }
}
