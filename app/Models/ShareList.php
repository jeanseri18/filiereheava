<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareList extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_group',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function group()
    {
        return $this->belongsTo(ShareGroup::class, 'id_group');
    }
}
