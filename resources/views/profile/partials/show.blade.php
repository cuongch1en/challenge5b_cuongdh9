@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thông tin cá nhân</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Ngày tạo tài khoản:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Chỉnh sửa thông tin</a>
            <!-- <a href="{{ route('profile.edit') }}" class="btn btn-primary">Chỉnh sửa thông tin</a> -->

        </div>
    </div>
</div>
@endsection
