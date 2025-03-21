@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-12 px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Danh sách người dùng</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg shadow w-full">
            <table class="min-w-full w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/4 text-left py-4 px-6 font-semibold">Email</th>
                        <th class="w-1/4 text-left py-4 px-6 font-semibold">Tên</th>
                        <th class="w-1/4 text-left py-4 px-6 font-semibold">Vai trò</th>
                        @if(Auth::user()->role === 'admin')
                            <th class="w-1/4 text-left py-4 px-6 font-semibold">Hành động</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 border-b">{{ $user->email }}</td>
                            <td class="py-4 px-6 border-b">{{ $user->name }}</td>
                            <td class="py-4 px-6 border-b">{{ $user->role }}</td>

                            @if(Auth::user()->role === 'admin')
                                <td class="py-4 px-6 border-b">
                                    <div class="flex items-center space-x-4">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-black font-medium py-2 px-4 rounded-lg transition-colors">
                                            Sửa
                                        </a>
                                        <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-black font-medium py-2 px-4 rounded-lg transition-colors"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection