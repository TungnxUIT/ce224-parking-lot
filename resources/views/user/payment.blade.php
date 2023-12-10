@extends('layouts.app')
@section('content')

<div class="container">
    <form action="{{ route('post.momo', ['id' => Auth::user()->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="create">
        <h2>Nạp tiền</h2>
        <br />
        <div class="form-group">
            <label for="txtamount">Số tiền</label>
            <input type="text" class="form-control" name="amount" id="txtamount">
            <div class="input-group-btn">
                <br>
                <button class="btn btn-danger" type="submit">Nạp tiền qua momo</button>
            </div>
        </div>
        @error('amount')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
    </form>
</div>

@endsection
