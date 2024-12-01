<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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

    public function users(): BelongsToMany
    {
        //withPivot digunakan untuk mengakses kolom 'quantity' pada tabel pivot product_user
        return $this->belongsToMany(User::class, 'cards_user')->withPivot('quantity');
    }

    public function decks()
    {
        return $this->belongsToMany(Deck::class)->withPivot('quantity');
    }
}
