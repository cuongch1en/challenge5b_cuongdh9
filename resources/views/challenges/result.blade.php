@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chúc mừng! Bạn đã trả lời đúng.</h2>
    <h3>Nội dung của thử thách:</h3>
    <pre>{{ $content }}</pre>
</div>
@endsection
