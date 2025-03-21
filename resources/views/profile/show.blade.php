@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                Thông tin cá nhân
            </h2>
            <div class="mt-4 h-1 w-20 bg-blue-500 rounded-full mx-auto"></div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <div class="space-y-6">
                <!-- User Information -->
                <div class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg">
                    <div class="flex-1 space-y-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-500">Họ tên</span>
                        </div>
                        <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg">
                    <div class="flex-1 space-y-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-500">Email</span>
                        </div>
                        <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-4 bg-blue-50 rounded-lg">
                    <div class="flex-1 space-y-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-500">Ngày tạo tài khoản</span>
                        </div>
                        <p class="text-lg font-semibold text-gray-800">{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex justify-center space-x-4">
                    <a href="{{ route('profile.edit') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-black rounded-lg
                              hover:shadow-md transition-all flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 114.95 0 2.5 2.5 0 01-4.95 0z" />
                        </svg>
                        Chỉnh sửa thông tin
                    </a>

                    <a href="{{ route('password.change') }}" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-black rounded-lg
                              hover:shadow-md transition-all flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2h2v2l4-4a6 6 0 005.743-4.657A6 6 0 0018 9a6 6 0 00-1.757-4.243" />
                        </svg>
                        Đổi mật khẩu
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection