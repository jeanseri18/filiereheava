<?php

// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'id_direction'];

    public function direction()
    {
        return $this->belongsTo(Direction::class, 'id_direction');
    }
}
