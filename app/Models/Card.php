<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'card';
    protected $fillable = [
        'name',
        'type',
        // 'class_id',
        'mana',
        'attack',
        'health',
        'description',
        'photo',
        'is_legendary',
    ];
}
