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
                <h5>Card: {{ $card->id }}</h5>
                @foreach ($card->histories as $history)
                <p>Date: {{ $history->updated_at }}&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Status: {{ $history->status }}</p>
                @endforeach
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection