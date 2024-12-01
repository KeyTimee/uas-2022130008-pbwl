@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('storage/hs.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        color: white;
    }

    .main-content {
        background-color: rgba(0, 0, 0, 0.8); /* Transparansi untuk teks */
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }

    .title {
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    .description {
        font-size: 1.2rem;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Menurunkan posisi konten di dalam container */
    .container.text-center {
        margin-top: 100px; /* Jarak atas untuk kontainer */
    }

    /* Styling untuk bagian "You are logged in!" */
    .alert-success {
        background-color: #28a745; /* Warna hijau cerah */
        color: white;
        font-size: 1.2rem;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
    }

    /* Styling untuk card-body */
    .card-body {
        background-color: rgba(0, 0, 0, 0.5); /* Transparansi di dalam card */
        border-radius: 10px;
        padding: 20px;
        color: white;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
    }

</style>

<div class="container text-center">
    <div class="main-content">
        <h1 class="title">Welcome to Hearthstone Deck Builder</h1>
        <p class="description">Craft, manage, and explore your decks like a true Hearthstone master!</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('decks.index') }}" class="btn btn-primary btn-lg">View Decks</a>
            <a href="{{ route('deckcards.index') }}" class="btn btn-secondary btn-lg">Create a Deck</a>
        </div>
    </div>
</div>

@endsection
