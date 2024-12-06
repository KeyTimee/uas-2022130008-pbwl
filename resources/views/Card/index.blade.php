@extends('layouts.app')

@section('content')
<style>
    /* Background untuk halaman */
    body {
        /* background: url('{{ asset('storage/images/background.jpg') }}') no-repeat center center fixed; */
        background-size: cover;
        color: white;
    }

    /* Form Styling */
    .container {
        margin-top: 10px;
        padding: 25px;
        background-color: rgba(0, 0, 0, 0.4); /* Background dengan transparansi */
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }

    .form-label {
        font-weight: bold;
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
        border-color: #ffcc00; /* Ganti warna border saat fokus */
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
</style>
    <div class="container">
        <main>
            <a class="btn btn-primary" href="{{ route('card.create') }}">Add New</a>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Class/Category</th>
                        <th>Mana</th>
                        <th>Attack</th>
                        <th>Health</th>
                        <th>Description</th>
                        <th>Legendary</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cards as $card)
                        <tr>
                            <td>{{ '#' . str_pad($card->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <img src="{{ Storage::url($card->photo) }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td>
                                <a href="{{ route('card.show', $card) }}">
                                    {{ $card->name }}
                                </a>
                            </td>
                            <td>{{ $card->type }}</td>
                            <td>{{ $card->category->name ?? 'Neutral' }}</td>
                            <td>{{ $card->mana }}</td>
                            <td>{{ $card->attack }}</td>
                            <td>{{ $card->health }}</td>
                            <td>{{ $card->description }}</td>
                            <td>{{ $card->is_legendary ? 'true' : 'false' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('card.edit', $card) }}">Edit</a>
                                    <form action="{{ route('card.destroy', $card) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $cards->links() }}
        </main>
    </div>
@endsection
