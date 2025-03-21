@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4 p-8">
        <div class="max-w-lg mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Gửi Tin Nhắn</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-lg p-8 ">
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf

                    <!-- Receiver Selection -->
                    <div class="mb-6">
                        <label for="receiver_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Người nhận
                        </label>
                        <select name="receiver_id" id="receiver_id" class="block w-full rounded-md border-gray-300 shadow-sm 
                                       focus:border-indigo-500 focus:ring-indigo-500
                                       py-2 px-3 transition duration-150 ease-in-out" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Message Content -->
                    <div class="mb-8">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Nội dung tin nhắn
                        </label>
                        <textarea name="message" id="message" class="block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-indigo-500 focus:ring-indigo-500
                                         py-2 px-3 h-32 resize-none transition duration-150 ease-in-out" rows="4"
                            required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-black font-medium 
                                   py-2 px-4 rounded-md transition duration-150 ease-in-out
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Gửi Tin Nhắn
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection