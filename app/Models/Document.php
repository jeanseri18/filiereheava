<?php
// app/Models/Document.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'file_url', 'id_creator', 'type_doc', 'type_share', 'status',
    ];

    // Relation avec l'utilisateur (créateur du document)
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_creator');
    }
}
