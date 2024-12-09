@extends('layouts.app')

@section('content')
    <style>
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
        <h3>Edit Deck</h3>
        <form action="{{ route('decks.update', $deck) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Deck Name -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Deck Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $deck->name }}" required>
            </div>

            <!-- Deck Class -->
            <div class="form-group mb-3">
                <label for="deck_class" class="form-label">Deck Class:</label>
                <select class="form-control" id="deck_class" name="deck_class" required>
                    <option value="" disabled>Select Deck Class</option>
                    @foreach (['Warrior', 'Mage', 'Druid', 'Hunter'] as $class)
                        <option value="{{ $class }}" {{ $deck->deck_class === $class ? 'selected' : '' }}>
                            {{ $class }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Deck Type -->
            <div class="form-group mb-3">
                <label for="deck_type_id" class="form-label">Deck Type:</label>
                <select class="form-control @error('deck_type_id') is-invalid @enderror" name="deck_type_id"
                    id="deck_type_id">
                    <option value="">Select a category</option>
                    @foreach ($deckTypes as $deckType)
                        <option value="{{ $deckType->id }}"
                            {{ old('deck_type_id', $deck->deck_type_id) == $deckType->id ? 'selected' : '' }}>
                            {{ $deckType->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Cards in Deck -->
            <div class="mt-4">
                <h4>Cards in Deck</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Card Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deck->cards as $card)
                            <tr>
                                <td>{{ $card->name }}</td>
                                <td>
                                    <!-- Form untuk mengubah quantity -->
                                    <input type="number" name="quantity[{{ $card->id }}]"
                                        value="{{ $card->pivot->quantity }}" min="0">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Update Deck Button -->
                <button type="submit" class="btn btn-primary mt-3">Update Deck</button>
        </form>
    </div>
@endsection
