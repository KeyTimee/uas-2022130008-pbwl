<?php

namespace App\Http\Controllers;

use App\Models\DeckType;
use Illuminate\Http\Request;

class DeckTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deckTypes = DeckType::paginate();
        return view('decktype.index', compact('deckTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('decktype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'string|max:150',
            'is_active' => 'required|boolean',
        ]);

        DeckType::create($request->all());
        return redirect()->route('deck_types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeckType $deckType)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeckType $deckType)
    {
        return view('decktype.edit', compact('deckType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeckType $deckType)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'string|max:150',
            'is_active' => 'boolean',
        ]);

        $deckType->update($request->all());
        return redirect()->route('deck_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeckType $deckType)
    {
        $deckType->delete();
        return redirect()->route('deck_types.index');
    }
}
