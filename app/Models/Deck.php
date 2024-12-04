<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $table = 'decks';
    protected $fillable = ['user_id', 'name', 'deck_type_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class)->withPivot('quantity');
    }

    public function deckType()
    {
        return $this->belongsTo(DeckType::class);
    }
}
