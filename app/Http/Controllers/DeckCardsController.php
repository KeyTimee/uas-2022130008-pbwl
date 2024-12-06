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
        $quantityToAdd = $request->input('quantity', 1);
        $maxQuantity = $card->is_legendary ? 1 : 2;

        // Cek total jumlah kartu yang ada dalam deck
        $totalCardsInDeck = $user->cards->sum('pivot.quantity');

        // Validasi jika total kartu sudah mencapai batas 30
        if ($totalCardsInDeck + $quantityToAdd > 30) {
            return redirect()->route('deckcards.index')->with('error', 'Total kartu dalam deck tidak boleh lebih dari 30.');
        }

        // Cek apakah kartu sudah ada di deck
        if ($user->cards->contains($card)) {
            // Cek jumlah kartu yang ingin ditambahkan
            $currentQuantity = $user->cards->find($card)->pivot->quantity;
            $newQuantity = $currentQuantity + $quantityToAdd;

            // Validasi jika kartu biasa melebihi 2 atau kartu legendary lebih dari 1
            if ($newQuantity > $maxQuantity) {
                return redirect()->route('deckcards.index')->with(
                    'error',
                    $card->is_legendary
                        ? 'Kartu legendary hanya dapat ditambahkan 1 kali ke dalam deck.'
                        : 'Kartu biasa hanya dapat ditambahkan maksimal 2 salinan ke dalam deck.'
                );
            }

            // Update jumlah kartu jika masih dalam batas yang diperbolehkan
            $user->cards()->updateExistingPivot($card, ['quantity' => $newQuantity]);
        } else {
            // Jika kartu belum ada di deck, langsung ditambahkan
            $user->cards()->attach($card, ['quantity' => $quantityToAdd]);
        }

        return redirect()->route('deckcards.index', $request->except('_token'))->with('success', 'Kartu berhasil ditambahkan ke dalam deck.');
    }





    public function removeFromDeck(Card $card)
    {
        $user = Auth::user();
        $user->cards()->detach($card);
        return redirect()->route('deckcards.index');
    }
}
