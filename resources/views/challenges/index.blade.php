@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg flex items-center">
                <svg class="w-5 h-5 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-red-800">{{ session('error') }}</span>
            </div>
        @endif

        @if(auth()->user()->role === 'admin')
            <div class="bg-white rounded-xl shadow-sm p-6 mb-12">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Tạo thử thách mới</h3>
                <form action="{{ route('challenges.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <input type="file" name="file" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <input type="text" name="hint" placeholder="Nhập gợi ý" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-black px-6 py-3 rounded-lg
                                   hover:shadow-md transition-all flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tạo thử thách
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Thử thách có sẵn</h3>

            <div class="space-y-6">
                @foreach($challenges as $challenge)
                    <div class="border rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-gray-500 font-mono">#{{ $challenge->id }}</span>
                        </div>

                        <div class="space-y-4">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-blue-800 font-medium">💡 Gợi ý: {{ $challenge->hint }}</p>
                            </div>

                            @if(auth()->user()->role !== 'admin')
                                <form action="{{ route('challenges.check', $challenge->id) }}" method="POST" class="flex gap-4">
                                    @csrf
                                    <input type="text" name="answer" placeholder="Nhập đáp án..." required
                                        class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">

                                    <button type="submit" class="bg-green-600 text-black px-6 py-2 rounded-lg hover:bg-green-700 
                                               transition-colors flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Kiểm tra
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if($challenges->isEmpty())
                    <div class="text-center py-12 text-gray-500">
                        <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <p class="mt-4 text-lg">Chưa có thử thách nào được tạo</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection