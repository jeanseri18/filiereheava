<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_document',
        'id_validator',
        'validation_order',
        'status',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'id_document');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'id_validator');
    }
}
