@extends('layouts.app')

@section('content')
    <style>
        body {
            background-size: cover;
            color: white;
        }

        .container {
            margin-top: 10px;
            padding: 25px;
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .form-label {
            font-weight: bold;
            color: white;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid #ccc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ffcc00;
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
    </style>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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

            <div class="form-group mt-3">
                <label for="deck_class">Deck Class:</label>
                <select class="form-select" id="deck_class" name="deck_class" required>
                    <option value="" disabled selected>Select Class</option>
                    <option value="Warrior">Warrior</option>
                    <option value="Mage">Mage</option>
                    <option value="Druid">Druid</option>
                    <option value="Hunter">Hunter</option>
                </select>
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
                    <th>Actions</th>
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
                        <td colspan="6">Your deck is empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
