@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('post.registercard', ['id' => Auth::user()->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="create">
        <h2>Đăng ký thẻ xe</h2>
        <br />
        <div class="form-group">
            <label for="txtlicense_plates">Biển số xe</label>
            <input type="text" class="form-control" name="license_plates" id="txtlicense_plates">
            
            @error('license_plates')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <div class="input-group-btn">
                <button class="btn btn-danger" type="submit">Đăng ký</button>
            </div>
        </div>
        <br />
    </form>
</div>
@endsection
