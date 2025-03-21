@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nộp Bài Làm: {{ $assignment->title }}</h2>

    <form action="{{ route('submissions.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Chọn File</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Nộp Bài</button>
    </form>
</div>
@endsection
