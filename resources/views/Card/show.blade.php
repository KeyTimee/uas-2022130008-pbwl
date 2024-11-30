@extends('layouts.app')

@section('content')
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
