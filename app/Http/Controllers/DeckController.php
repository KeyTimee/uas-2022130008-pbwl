<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;

class DeckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cards = Auth::user()->cards;
        return view('deck', compact('cards'));
    }

    public function addToDeck(Card $card, Request $request)
    {
        $user = Auth::user();
        $deck = $user->cards;

        // Hitung total kartu di deck
        $totalCardsInDeck = $deck->sum('pivot.quantity');

        // Periksa jika deck sudah penuh
        if ($totalCardsInDeck >= 30) {
            return redirect()->route('deck.index')->with('error', 'Deck sudah mencapai batas maksimum 30 kartu.');
        }

        // Periksa jika kartu yang ingin ditambahkan sudah mencapai batas
        $existingCard = $deck->find($card->id);
        $quantityToAdd = $request->quantity ?? 1;

        if ($existingCard) {
            $newQuantity = $existingCard->pivot->quantity + $quantityToAdd;

            // Cek batas untuk kartu legendary atau kartu biasa
            if ($card->is_legendary && $newQuantity > 1) {
                return redirect()->route('deck.index')->with('error', 'Kartu legendary hanya dapat ditambahkan 1 kali ke dalam deck.');
            } elseif (!$card->is_legendary && $newQuantity > 2) {
                return redirect()->route('deck.index')->with('error', 'Kartu biasa hanya dapat ditambahkan maksimal 2 salinan ke dalam deck.');
            }

            // Update jumlah kartu
            $user->cards()->updateExistingPivot($card, [
                'quantity' => $newQuantity
            ]);
        } else {
            // Cek batas langsung saat kartu belum ada di deck
            if ($card->is_legendary && $quantityToAdd > 1) {
                return redirect()->route('deck.index')->with('error', 'Kartu legendary hanya dapat ditambahkan 1 kali ke dalam deck.');
            } elseif (!$card->is_legendary && $quantityToAdd > 2) {
                return redirect()->route('deck.index')->with('error', 'Kartu biasa hanya dapat ditambahkan maksimal 2 salinan ke dalam deck.');
            }

            // Attach kartu ke deck
            $user->cards()->attach($card, ['quantity' => $quantityToAdd]);
        }

        return redirect()->route('deck.index')->with('success', 'Kartu berhasil ditambahkan ke deck.');
    }
}
