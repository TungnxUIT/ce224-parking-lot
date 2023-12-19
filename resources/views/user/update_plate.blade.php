@extends('layouts.app')
@section('content')

<div class="container">
    <form action="{{ route('put.updatecard', ['cardId' => $cardId, 'id' => $id]) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="action" value="update">
        <h2>Chỉnh sửa biển số xe</h2>
        <br />
        <div class="form-group">
            <label for="txtamount">Biển số xe</label>
            <input type="text" class="form-control" name="license_plates" id="txtamount">
            <div class="input-group-btn">
                <br>
                <button class="btn btn-danger" type="submit">Cập nhật biển số xe</button>
            </div>
        </div>
        @error('license_plates')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br />
    </form>
</div>

@endsection