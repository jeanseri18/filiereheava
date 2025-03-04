<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'type', 'attachment','id_user'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
