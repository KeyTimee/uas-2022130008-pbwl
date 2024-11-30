@extends('layouts.app')

@section('content')
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
            <form action="{{ route('card.update', $card) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            id="name" value="{{ old('name', $card->name) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="type">Type</label>
                        <select class="form-select @error('type') is-invalid @enderror" aria-label="Default select example"
                            name="type" id="type">
                            <option value="" disabled {{ old('type', $card->type) ? '' : 'selected' }}>Select Type
                            </option>
                            <option value="Minion" {{ old('type', $card->type) == 'Minion' ? 'selected' : '' }}>Minion
                            </option>
                            <option value="Spell" {{ old('type'), $card->type == 'Spell' ? 'selected' : '' }}>Spell
                            </option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-12">
                        <label class="form-label" for="class_id">Class</label>
                        <select class="form-select @error('class_id') is-invalid @enderror" aria-label="Select Class"
                            name="class_id" id="class_id">
                            <option value="" disabled {{ old('class_id', $card->class_id) ? '' : 'selected' }}>Select
                                Class</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('class_id', $card->class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-6">
                        <label class="form-label" for="mana">Mana</label>
                        <input class="form-control @error('mana') is-invalid @enderror" type="number" name="mana"
                            id="mana" value="{{ old('mana', $card->mana) }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="attack">Attack</label>
                        <input class="form-control @error('attack') is-invalid @enderror" type="number" name="attack"
                            id="attack" value="{{ old('attack', $card->attack) }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="health">Health</label>
                        <input class="form-control @error('health') is-invalid @enderror" type="number" name="health"
                            id="health" value="{{ old('health', $card->health) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                            rows="3">{{ old('description', $card->description) }}</textarea>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="is_legendary" value="0">
                        <input class="form-check-input @error('is_legendary') is-invalid @enderror" type="checkbox"
                            name="is_legendary" value="1" id="is_legendary"
                            {{ old('is_legendary', $card->is_legendary) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_legendary">
                            Legendary
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="photo">Photo</label>
                        <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo"
                            id="photo">
                        <img src="{{ Storage::url($card->photo) }}" class="img-thumbnail w-25">
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="category_id">Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                            id="category_id">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $card->category_id) == $category->id ? 'selected' : '' }}>
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
