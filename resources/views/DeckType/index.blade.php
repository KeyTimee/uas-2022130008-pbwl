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

    .legendary-checkbox {
    margin-left: 20px; /* Menambah jarak ke kiri */
}
</style>
    <div class="container">
        <main>
            <a class="btn btn-primary" href="{{ route('deck_types.create') }}">Add New</a>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Deck Types Name</th>
                        <th>Description</th>
                        <th>Is Active?</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($deckTypes as $deckType)
                        <tr>
                            <td>{{ $deckType->id }}</td>
                            <td>{{ $deckType->name }}</td>
                            <td>{{ $deckType->description }}</td>
                            <td>{{ $deckType->is_active ? 'Yes' : 'No' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('deck_types.edit', $deckType) }}">
                                        Edit
                                    </a>
                                    <form action="{{ route('deck_types.destroy', $deckType) }}" method="POST">
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

            {{ $deckTypes->links() }}
        </main>
    </div>
@endsection
