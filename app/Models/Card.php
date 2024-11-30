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
        'mana',
        'attack',
        'health',
        'description',
        'photo',
        'is_legendary',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
