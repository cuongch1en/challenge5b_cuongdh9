@extends('layouts.app')

@section('content')
    <div class="w-full">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center m-5">Tin Nhắn Đã Nhận</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="overflow-x-auto rounded-lg shadow w-full">
            <table class="min-w-full w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/4 py-4 px-6 font-semibold text-center">Người Gửi</th>
                        <th class="w-1/4 py-4 px-6 font-semibold text-center">Nội Dung</th>
                        <th class="w-1/4 py-4 px-6 font-semibold text-center">Thời Gian</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($messages as $message)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 border-b">{{ $message->sender->name }}</td>
                            <td class="py-4 px-6 border-b">{{ $message->message }}</td>
                            <td class="py-4 px-6 border-b">{{ $message->created_at->format('d/m/Y H:i') }}</td>

                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection