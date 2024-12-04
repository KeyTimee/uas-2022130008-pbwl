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

        // Filter berdasarkan kategori
        if ($categories = $request->input('categories')) {
            $query->whereHas('category', function ($q) use ($categories) {
                $q->whereIn('name', $categories);
            });
        }

        // Cek jika request memiliki parameter 'search' untuk pencarian nama kartu
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        // Ambil data dengan pagination dan sertakan parameter 'search' dan 'categories' untuk query string
        $cards = $query->paginate(12)->appends($request->only('search', 'categories'));

        // Kembalikan ke view
        return view('main', compact('cards'));
    }
}
