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

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            id="name" value="{{ old('name') }}">
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="description">Description</label>
                        <input class="form-control @error('description') is-invalid @enderror" type="text"
                            name="description" id="description" value="{{ old('description') }}">
                    </div>

                    <div class="col-6 mt-3">
                        <label class="form-label" for="is_active">Is Active</label>
                        <select class="form-control @error('is_active') is-invalid @enderror" name="is_active"
                            id="is_active">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <button class="btn btn-primary mt-3" type="submit">Add</button>
                </div>
            </form>
        </main>
    </div>
@endsection
