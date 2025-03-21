@extends('layouts.app')

@section('content')
<h2>Chỉnh sửa thông tin người dùng</h2>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <label for="name">Tên:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>

    <button type="submit">Cập nhật</button>
</form>

<a href="{{ route('users.index') }}">Quay lại danh sách</a>
@endsection
