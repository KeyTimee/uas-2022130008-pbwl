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
        // Ambil data filter
        $search = $request->input('search');
        $categories = $request->input('categories', []);

        // Query kartu berdasarkan filter
        $query = Card::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereHas('category', function ($q) use ($categories) {
                $q->whereIn('name', $categories);
            });
        }

        // Dapatkan hasil paginasi
        $cards = $query->paginate(12);

        return view('main', compact('cards'));
    }
}
