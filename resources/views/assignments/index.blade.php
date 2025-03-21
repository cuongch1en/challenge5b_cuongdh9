@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                    Danh Sách Bài Tập
                </h2>

                @if(auth()->user()->role === 'admin')
                    <div class="mb-8 flex justify-center">
                        <a href="{{ route('assignments.create') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 text-black px-6 py-3 rounded-lg 
                                  shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Upload Bài Tập
                        </a>
                    </div>
                @endif
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 rounded-lg flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-800 ">
                        <tr>
                            <th class="py-5 px-6 text-left font-semibold text-white">Tiêu Đề</th>
                            <th class="py-5 px-6 text-left font-semibold text-white">Mô Tả</th>
                            <th class="py-5 px-6 text-center font-semibold text-white">File</th>
                            <th class="py-5 px-6 text-center font-semibold text-white">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($assignments as $assignment)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="py-4 px-6 font-medium text-gray-800">{{ $assignment->title }}</td>
                                <td class="py-4 px-6 text-gray-600 max-w-xs">{{ Str::limit($assignment->description, 50) }}</td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('assignments.download', $assignment->id) }}"
                                        class="inline-flex items-center text-green-600 hover:text-green-800 transition-colors">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Tải Về
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-center space-x-3">
                                    @if(auth()->user()->role !== 'admin')
                                        <a href="{{ route('submissions.create', $assignment->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-black rounded-lg 
                                                  hover:bg-blue-700 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Nộp Bài
                                        </a>
                                    @endif

                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('submissions.index', $assignment->id) }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-black rounded-lg 
                                                  hover:bg-purple-700 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2 17.5A2.5 2.5 0 014.5 15h15a2.5 2.5 0 010 5h-15A2.5 2.5 0 012 17.5z" />
                                            </svg>
                                            Xem Bài
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($assignments->isEmpty())
                <div class="mt-12 text-center text-gray-500">
                    <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="mt-4 text-lg">Chưa có bài tập nào được đăng tải</p>
                </div>
            @endif
        </div>
    </div>
@endsection