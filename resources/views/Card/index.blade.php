@extends('layouts.app')

@section('content')
    <div class="container">
        <main>
            <a class="btn btn-primary" href="{{ route('card.create') }}">Add New</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Class/Category</th>
                        <th>Mana</th>
                        <th>Attack</th>
                        <th>Health</th>
                        <th>Description</th>
                        <th>Legendary</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cards as $card)
                        <tr>
                            <td>{{ '#' . str_pad($card->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <img src="{{ Storage::url($card->photo) }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td>
                                <a href="{{ route('card.show', $card) }}">
                                    {{ $card->name }}
                                </a>
                            </td>
                            <td>{{ $card->type }}</td>
                            <td>{{ $card->category->name ?? 'Neutral' }}</td>
                            <td>{{ $card->mana }}</td>
                            <td>{{ $card->attack }}</td>
                            <td>{{ $card->health }}</td>
                            <td>{{ $card->description }}</td>
                            <td>{{ $card->is_legendary ? 'true' : 'false' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-warning" href="{{ route('card.edit', $card) }}">Edit</a>
                                    <form action="{{ route('card.destroy', $card) }}" method="POST">
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

            {{ $cards->links() }}
        </main>
    </div>
@endsection
