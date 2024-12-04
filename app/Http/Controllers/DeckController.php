<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\DeckType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        // Membuat deck baru
        $deck = $user->decks()->create([
            'name' => $deckName,
        ]);

        // Menambahkan kartu ke deck
        $cards = $user->cards;  // Ambil kartu yang sudah dipilih

        foreach ($cards as $card) {
            $deck->cards()->attach($card, ['quantity' => $card->pivot->quantity]);
        }

        $user->cards()->detach();

        return redirect()->route('decks.index')->with('success', 'Deck berhasil dibuat.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'deck_type_id' => 'nullable|exists:deck_types,id',
        ]);

        // Update nama deck
        $deck->update([
            'name' => $request->name,
            'deck_type_id' => $request->deck_type_id,
        ]);

        return redirect()->route('decks.index')->with('success', 'Deck berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deck $deck)
    {
        $deck->delete();
        return redirect()->route('decks.index');
    }
}
