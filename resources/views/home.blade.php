@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bãi đỗ xe thông minh') }}</div>

                <div class="card-body">
                    <p>Số người đăng ký sử dụng dịch vụ: {{ $user_count }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
