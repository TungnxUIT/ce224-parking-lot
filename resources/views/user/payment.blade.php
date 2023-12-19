@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ route('post.momo', ['id' => Auth::user()->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="create">
        <h2>Nạp tiền</h2>
        <br />
        @if(request()->has('qr_code'))
        <div class="form-group">
            <img src="{{ request()->get('qr_code') }}" alt="QR Code">
        </div>
        <div class="form-group">
        <a class="btn btn-danger"  href="{{ route('profile', ['id' => Auth::user()->id]) }}" class="btn btn-danger">Đã thanh toán</a>
        </div>
</div>
@else
<div class="form-group">
    <label for="txtamount">Số tiền</label>
    <input type="text" class="form-control" name="amount" id="txtamount">
</div>

<div class="form-group">
    <label for="payment_type">Phương thức thanh toán</label>
    <select class="form-control" name="payment_type" id="payment_type">
        <option value="0">Thanh toán bằng thẻ</option>
        <option value="1">Thanh toán bằng QR code</option>
    </select>
</div>

<br>

<div class="form-group">
    <button class="btn btn-danger" type="submit">Thanh toán Momo</button>
</div>
@endif


@error('amount')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<br />
</form>
</div>

@endsection