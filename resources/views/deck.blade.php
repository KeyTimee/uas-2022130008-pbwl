@extends('layouts.app')

@section('content')
    <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Card Name</th>
                        <th>Quantity</th>
                        <th>Mana</th>
                        <th>Type</th>
                        <th>Class/Category</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cards as $card)
                        <tr>
                            <td>{{ $card->name }}</td>
                            <td>{{ $card->pivot->quantity }}</td>
                            <td>{{ $card->mana }}</td>
                            <td>{{ $card->type }}</td>
                            <td>{{ $card->category->name ?? 'Neutral' }}</td>
                            <td>
                                <form action="{{ route('deck.remove', $card) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Your deck is empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    </div>
@endsection
