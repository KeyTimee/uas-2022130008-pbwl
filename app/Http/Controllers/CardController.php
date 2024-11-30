<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::paginate();
        return view('card.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('card.create');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->hashName();
            $filePath = $file->storeAs('public', $fileName);
            $card->update([
                'photo' => $filePath
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Minion,Spell',
            // 'class_id' => 'required|exists:card_classes,id',
            'mana' => 'required|integer|min:0',
            'attack' => 'nullable|integer|min:0',
            'health' => 'nullable|integer|min:0',
            'description' => 'required|string',
            'is_legendary' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $is_legendary = $request->input('is_legendary', false);

        $card = Card::create($request->all());

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->hashName();
            $filePath = $file->storeAs('public', $fileName);
            $card->update([
                'photo' => $filePath
            ]);
        }


        return redirect()->route('card.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        return view('card.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        return view('card.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Minion,Spell',
            'mana' => 'required|integer|min:0',
            'attack' => 'nullable|integer|min:0',
            'health' => 'nullable|integer|min:0',
            'description' => 'required|string',
            'is_legendary' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $card->update($request->except(['_token', '_method']));

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->hashName();
            $filePath = $file->storeAs('public', $fileName);

            $card->update([
                'photo' => $filePath,
            ]);
        }

        return redirect()->route('card.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        $card->delete();
        return redirect()->route('card.index');
    }
}
