<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_document',
        'archived_by',
        'archive_date',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'id_document');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'archived_by');
    }
}

