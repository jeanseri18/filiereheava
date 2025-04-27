<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRh extends Model
{
    use HasFactory;

    protected $table = 'document_rh';

    protected $fillable = [
        'nom_document',
        'famille',
        'sous_famille',
        'user_id',  // lien avec l'utilisateur
        'file_url',
      // lien avec la sous-catégorie
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'famille');
    }

    // Relation avec la sous-catégorie
    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class, 'sous_famille');
    }
}
