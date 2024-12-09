<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Card;
use App\Models\DeckType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $decks = Auth::user()->decks;
        return view('decks.index', compact('decks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $deckName = $request->input('name');
        $deckClass = $request->input('deck_class');

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'deck_class' => 'required|string|max:255',
        ]);

        // Membuat deck baru
        $deck = $user->decks()->create([
            'name' => $deckName,
            'deck_class' => $deckClass,
        ]);

        // Menambahkan kartu ke deck (jika ada)
        $cards = $user->cards; // Ambil kartu yang sudah dipilih

        foreach ($cards as $card) {
            $deck->cards()->attach($card, ['quantity' => $card->pivot->quantity]);
        }

        // Hapus kartu dari sementara
        $user->cards()->detach();

        return redirect()->route('decks.index')->with('success', 'Deck berhasil dibuat.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'deck_class' => 'required|string|max:255',
        ]);

        // Membuat deck baru
        $deck = $user->decks()->create([
            'name' => $request->input('name'),
            'deck_class' => $request->input('deck_class'),
        ]);

        return redirect()->route('decks.index')->with('success', 'Deck berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $decks = Auth::user()->decks;
        return view('decks.index', compact('decks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deck $deck)
    {
        // Pastikan deck milik user yang sedang login
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $deck->load('cards');

        // Tampilkan halaman edit
        $deckTypes = DeckType::where('is_active', true)->get();
        return view('decks.edit', compact('deck', 'deckTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deck $deck)
    {
        // Pastikan deck milik user yang sedang login
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi input untuk deck
        $request->validate([
            'name' => 'required|string|max:255',
            'deck_class' => 'required|string|max:255',
            'deck_type_id' => 'nullable|exists:deck_types,id',
        ]);

        // Update nama deck
        $deck->update([
            'name' => $request->name,
            'deck_class' => $request->deck_class,
            'deck_type_id' => $request->deck_type_id,
        ]);

        // Update atau hapus kartu berdasarkan quantity
        if ($request->has('quantity')) {
            foreach ($request->quantity as $cardId => $quantity) {
                if ($quantity == 0) {
                    // Jika quantity 0, hapus kartu dari deck
                    $deck->cards()->detach($cardId);
                } else {
                    // Jika quantity lebih dari 0, update quantity kartu
                    $deck->cards()->updateExistingPivot($cardId, ['quantity' => $quantity]);
                }
            }
        }

        return redirect()->route('decks.index')->with('success', 'Deck berhasil diupdate.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deck $deck)
    {
        $deck->delete();
        return redirect()->route('decks.index')->with('success', 'Deck berhasil dihapus.');
    }

    public function removeCard(Deck $deck, Card $card)
    {
        // Pastikan deck milik user yang sedang login
        if ($deck->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus kartu dari deck
        $deck->cards()->detach($card->id);

        return redirect()->back()->with('success', 'Card removed from the deck.');
    }
}
