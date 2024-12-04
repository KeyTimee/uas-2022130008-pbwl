@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Flash Messages -->
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

        <!-- Search and Filter Form -->
        <form action="{{ url()->current() }}" method="GET" class="mb-4">
            <div class="row">
                <!-- Kolom Pencarian -->
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control bg-dark text-white border-secondary"
                            placeholder="Search cards..." value="{{ request('search') }}">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </div>
                </div>

                <!-- Kolom Filter Kategori dan Tombol Apply Filter -->
                <div class="col-md-12 mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group flex-grow-1">
                            <label for="categories" class="form-label text-white">Filter Class(Please check neutral class and 1 non-neutral class only):</label>
                            <div class="d-flex flex-wrap">
                                @foreach (['Warrior', 'Mage', 'Druid', 'Hunter', 'Neutral'] as $category)
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                            value="{{ $category }}"
                                            {{ in_array($category, request('categories', [])) ? 'checked' : '' }}
                                            id="category-{{ $category }}">
                                        <label class="form-check-label text-white"
                                            for="category-{{ $category }}">{{ $category }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Tombol Apply Filter -->
                        <button class="btn btn-primary" type="submit">Apply Filter</button>
                    </div>
                </div>
            </div>
        </form>




        <!-- Cards Display -->
        <div class="row justify-content-center">
            @forelse ($cards as $card)
                @if (!request('categories') || (isset($card->category) && in_array($card->category->name, request('categories'))))
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm bg-dark text-white border-secondary">
                            <img class="card-img-top"
                                src="
                                    @isset($card->photo)
                                        {{ Storage::url($card->photo) }}
                                    @else
                                        {{ 'https://placehold.co/200' }}
                                    @endisset"
                                alt="{{ $card->name }}" width="100" height="300">
                            <div class="card-body">
                                <h5 class="card-title">{{ $card->name }}
                                    <span class="badge bg-primary">{{ $card->category->name ?? 'Neutral' }}</span>
                                </h5>
                                <p class="card-text">Mana: {{ $card->mana }}</p>
                                <p class="card-text">
                                    Legendary:
                                    <strong>{{ $card->is_legendary ? 'Yes' : 'No' }}</strong>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('card.show', $card) }}" type="button"
                                            class="btn btn-sm btn-outline-light">View</a>
                                    </div>
                                    @auth
                                        <form action="{{ route('deckcards.add', $card) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="number" name="quantity" value="1" min="1"
                                            class="form-control form-control-sm d-inline-block w-auto"
                                            max="{{ $card->is_legendary ? 1 : 2 }}">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Add to Deck</button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-12 text-center">
                    <p>No cards found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $cards->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: #121212;
            /* Dark background */
            color: #e0e0e0;
            /* Light text for better readability */
        }

        .card {
            border-radius: 10px;
            /* Softer corners */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            /* Smooth hover effect */
        }

        .card:hover {
            transform: scale(1.05);
            /* Slightly enlarge card */
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.2);
            /* Add a glowing shadow */
        }

        .card-img-top {
            width: 100px;
            height: 200px;
            object-fit: cover;
        }

        .btn-outline-light {
            border-color: #ffffff50;
            color: #e0e0e0;
        }

        .btn-outline-light:hover {
            background-color: #e0e0e0;
            color: #121212;
        }

        .alert {
            background-color: #2d2d2d;
            /* Dark alert background */
            color: #e0e0e0;
            /* Light text */
        }

        .alert-success {
            border-left: 5px solid #198754;
        }

        .alert-danger {
            border-left: 5px solid #dc3545;
        }
    </style>
@endsection
