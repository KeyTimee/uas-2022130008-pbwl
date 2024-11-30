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

            <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control  @error('name') is-invalid @enderror" type="text" name="name"
                            id="name" value="{{ old('name', $category->name) }}">
                    </div>


                    <div class="col-12 mt-3">
                        <label class="form-label" for="description">Description</label>
                        <input class="form-control @error('description') is-invalid @enderror" type="text"
                            name="description" id="description" value="{{ old('description', $category->description) }}">
                    </div>

                    <button class="btn btn-primary mt-3" type="submit">Update</button>
                </div>
            </form>
        </main>
    </div>
@endsection
