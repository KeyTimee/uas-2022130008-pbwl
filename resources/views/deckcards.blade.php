@extends('layouts.app')

@section('content')
<style>
    /* Background untuk halaman */
    /* Background untuk halaman */
    body {
        background-size: cover;
        color: white;
    }

    /* Form Styling */
    .container {
        margin-top: 10px;
        padding: 25px;
        background-color: rgba(0, 0, 0, 0.4);
        /* Background dengan transparansi */
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }

    .form-label {
        font-weight: bold;
        color: white;
        /* Mengubah warna tulisan menjadi putih */
    }

    .form-control,
    .form-select,
    .form-check-input {
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid #ccc;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ffcc00;
        /* Ganti warna border saat fokus */
        box-shadow: 0 0 5px rgba(255, 204, 0, 0.7);
    }

    .btn-primary {
        background-color: #ffcc00;
        border-color: #ffcc00;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background-color: #e6b800;
        border-color: #e6b800;
    }

    /* Styling untuk alert error */
    .alert-danger {
        background-color: rgba(255, 0, 0, 0.8);
        border-radius: 5px;
    }

    .form-check-label {
        color: white;
    }

    .form-check-input {
        margin-left: 10px;
    }

    .legendary-checkbox {
        margin-left: 20px;
        /* Menambah jarak ke kiri */
    }
</style>
    <div class="container">
        <!-- Tombol kembali ke halaman utama -->
        <div class="mb-3">
            <a href="{{ url('/add') }}" class="btn btn-secondary">Add More</a>
        </div>

        <!-- Form untuk input nama deck -->
        <form action="{{ route('decks.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Deck Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter deck name" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save Deck</button>
        </form>

        <hr>

        <!-- Tabel kartu dalam deck -->
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Card Name</th>
                    <th>Quantity</th>
                    <th>Mana</th>
                    <th>Type</th>
                    <th>Class/Category</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cards as $card)
                    <tr>
                        <td>{{ $card->name }}</td>
                        <td>{{ $card->pivot->quantity }}</td>
                        <td>{{ $card->mana }}</td>
                        <td>{{ $card->type }}</td>
                        <td>{{ $card->category->name ?? 'Neutral' }}</td>
                        <td>
                            <form action="{{ route('deckcards.remove', $card) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Your deck is empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
