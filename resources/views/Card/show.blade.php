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
    <div class='container'>
        <main>
            <h1>{{ $card->name }}</h1>
            <h2>Class/Category: {{ $card->category->name ?? 'Neutral' }}</h2>

            <div class="row">
                <div class="col-md-4">
                    <img src="{{ Storage::url($card->photo) }}" class="img-thumbnail"
                        style="width: 300px; height: 300px; object-fit: cover;" alt="{{ $card->name }}">
                </div>
                <div class="col-md-8">
                    <table class="table table-dark table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Type:</strong></td>
                                <td>{{ $card->type }}</td>
                            </tr>
                            <tr>
                                <td><strong>Mana:</strong></td>
                                <td>{{ $card->mana }}</td>
                            </tr>
                            <tr>
                                <td><strong>attack:</strong></td>
                                <td>{{ $card->attack }}</td>
                            </tr>
                            <tr>
                                <td><strong>health:</strong></td>
                                <td>{{ $card->health }}</td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td>{{ $card->description }}</td>
                            </tr>
                            <tr>
                                <td><strong>Legendary:</strong></td>
                                <td>{{ $card->is_legendary ? 'true' : 'false' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
@endsection
