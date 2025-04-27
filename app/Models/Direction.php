<?php

// app/Models/Direction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'status'];

    public function services()
    {
        return $this->hasMany(Service::class, 'id_direction');
    }
}
