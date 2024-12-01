@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <!-- Search Form -->
        <form action="{{ url()->current() }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search cards..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        <!-- Cards Display -->
        <div class="row justify-content-center">
            @foreach ($cards as $card)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="card-img-top"
                            src="
                                @isset($card->photo)
                                    {{ Storage::url($card->photo) }}
                                @else
                                    {{ 'https://placehold.co/200' }}
                                @endisset"
                            alt="{{ $card->name }}" width="100" height="250">
                        <div class="card-body">
                            <h5 class="card-title">{{ $card->name }}
                                <span class="badge bg-primary">{{ $card->category->name ?? 'Neutral' }}</span>
                            </h5>

                            <p class="card-text">Mana : {{ $card->mana }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('card.show', $card) }}" type="button"
                                        class="btn btn-sm btn-outline-secondary">View</a>
                                </div>
                                @auth
                                    <form action="{{ route('deckcards.add', $card) }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Add to Deck</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $cards->links() }}
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card-img-top {
            width: 100px;
            height: 200px;
            object-fit: cover;
            /* Crop image while maintaining aspect ratio */
        }
    </style>
@endsection
