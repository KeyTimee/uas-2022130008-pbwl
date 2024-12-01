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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('card.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            id="name" value="{{ old('name') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="type">Type</label>
                        <select class="form-select @error('type') is-invalid @enderror" aria-label="Default select example"
                            name="type" id="type">
                            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select Type</option>
                            <option value="Minion" {{ old('type') == 'Minion' ? 'selected' : '' }}>Minion</option>
                            <option value="Spell" {{ old('type') == 'Spell' ? 'selected' : '' }}>Spell</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="mana">Mana</label>
                        <input class="form-control @error('mana') is-invalid @enderror" type="number" name="mana"
                            id="mana" value="{{ old('mana') }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="attack">Attack</label>
                        <input class="form-control @error('attack') is-invalid @enderror" type="number" name="attack"
                            id="attack" value="{{ old('attack') }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="health">Health</label>
                        <input class="form-control @error('health') is-invalid @enderror" type="number" name="health"
                            id="health" value="{{ old('health') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                            rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="is_legendary" value="0">
                        <input class="form-check-input @error('is_legendary') is-invalid @enderror" type="checkbox"
                            name="is_legendary" value="1" id="is_legendary"
                            {{ old('is_legendary') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_legendary">
                            Legendary
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="photo">Photo</label>
                        <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo"
                            id="photo" value="{{ old('photo') }}">
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="category_id">Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary mt-3" type="submit">Add</button>

                </div>
            </form>
        </main>
    </div>
@endsection

