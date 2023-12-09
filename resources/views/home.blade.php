@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bãi đỗ xe thông minh') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{-- Thêm thông tin về trạng thái hoạt động của thẻ xe tại đây --}}
                    <div class="mt-4">
                        <h5>Thông tin thẻ xe</h5>
                        <p>Trạng thái hoạt động: [Thêm trạng thái ở đây]</p>
                        <p>Thông tin khác: [Thêm thông tin khác nếu cần]</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
