<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class MainController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
{
    // Query awal
    $query = Card::query();

    // Cek jika request memiliki parameter 'search'
    if ($request->filled('search')) { // Gunakan filled untuk mengecek jika tidak kosong
        // Filter berdasarkan nama
        $query->where('name', 'like', "%{$request->search}%");
    }

    // Ambil data dengan pagination dan sertakan parameter 'search' untuk query string
    $cards = $query->paginate(12)->appends($request->only('search'));

    // Kembalikan ke view
    return view('main', compact('cards'));
}

}
