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
        <h3>Edit Deck</h3>
        <form action="{{ route('decks.update', $deck) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Deck Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $deck->name }}" required>
            </div>
            <div class="col-6">
                <label class="form-label" for="deck_type_id">Deck Type</label>
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
            <button type="submit" class="btn btn-primary mt-3">Update Deck</button>
        </form>
    </div>
@endsection
