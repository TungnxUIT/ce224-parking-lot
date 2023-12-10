@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    User Information
                </div>
                <div class="card-body">
                    <ul>
                        <li><strong>Name:</strong> {{ $user->name }}</li>
                        <li><strong>Email:</strong> {{ $user->email }}</li>
                        <li><strong>Balance:</strong> {{ $user->balance }} vnd</li>
                    </ul>
                </div>
                @foreach ($cards as $card)
                <div class="card-body d-flex justify-content-between">
                    <ul>
                        <li><strong>Card ID:</strong> {{ $card->id }}</li>
                        <li><strong>License Plates:</strong> {{ $card->license_plates }}</li>
                        <li><strong>Status:</strong>
                            @if ($card->histories->isNotEmpty())
                            {{ $card->histories->last()->status }}
                            @else
                            N/A
                            @endif
                        </li>
                    </ul>
                    <form action="{{ route('delete.usercard', ['id' => $user->id, 'cardId' => $card->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete Card</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection