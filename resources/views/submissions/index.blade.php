@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh Sách Bài Làm - {{ $assignment->title }}</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Học Sinh</th>
                <th>File</th>
                <th>Thời Gian Nộp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $submission)
                <tr>
                    <td>{{ $submission->user->name }}</td>
                    <td><a href="{{ Storage::url($submission->file_path) }}" class="btn btn-success">Xem</a></td>
                    <td>{{ $submission->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
