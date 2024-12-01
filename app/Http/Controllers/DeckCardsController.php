<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

class DeckCardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cards = Auth::user()->cards;
        return view('deckcards', compact('cards'));
    }

    public function addToDeck(Card $card, Request $request)
    {
        $user = Auth::user();
        $deckCards = $user->cards;

        // Hitung total kartu di deck
        $totalCardsInDeck = $deckCards->sum('pivot.quantity');

        // Periksa jika deck sudah penuh
        if ($totalCardsInDeck >= 30) {
            return redirect()->route('deckcards.index')->with('error', 'Deck sudah mencapai batas maksimum 30 kartu.');
        }

        // Periksa kartu yang ingin ditambahkan
        $existingCard = $deckCards->find($card->id);
        $quantityToAdd = $request->input('quantity', 1);

        $maxQuantity = $card->is_legendary ? 1 : 2;
        $newQuantity = ($existingCard ? $existingCard->pivot->quantity : 0) + $quantityToAdd;

        if ($newQuantity > $maxQuantity) {
            return redirect()->route('deckcards.index')->with(
                'error',
                $card->is_legendary
                    ? 'Kartu legendary hanya dapat ditambahkan 1 kali ke dalam deck.'
                    : 'Kartu biasa hanya dapat ditambahkan maksimal 2 salinan ke dalam deck.'
            );
        }

        // Tambahkan atau perbarui kartu di deck
        if ($existingCard) {
            $user->cards()->updateExistingPivot($card, ['quantity' => $newQuantity]);
        } else {
            $user->cards()->attach($card, ['quantity' => $quantityToAdd]);
        }

        // ** Tambahkan Logika Penghapusan Data Setelah Dipindahkan **
        // Pindahkan data ke tabel baru (deck)
        $deck = $user->decks()->create([
            'name' => $request->input('deck_name', 'New Deck') // Nama deck dari request atau default
        ]);

        foreach ($deckCards as $card) {
            $deck->cards()->attach($card, ['quantity' => $card->pivot->quantity]);
        }

        return redirect()->route('deckcards.index')->with('success', 'Deck berhasil dibuat dan data lama dihapus.');
    }


    public function removeFromDeck(Card $card)
    {
        $user = Auth::user();
        $user->cards()->detach($card);
        return redirect()->route('deckcards.index');
    }
}
