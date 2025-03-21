<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role')->get(); // Lấy các thông tin cần thiết
        return view('user.dashboard', compact('users'));
    }
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Bạn không có quyền chỉnh sửa!');
        }

        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Kiểm tra nếu user hiện tại không phải admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'Bạn không có quyền cập nhật!');
        }

        // Validate dữ liệu nhập vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        // Lấy thông tin user từ database
        $user = User::findOrFail($id);

        // Cập nhật thông tin user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Điều hướng về danh sách user với thông báo thành công
        return redirect()->route('users.index')->with('success', 'Thông tin người dùng đã được cập nhật!');
    }

    public function destroy($id)
    {
        // Tìm user theo ID
        $user = User::findOrFail($id);

        // Kiểm tra nếu user muốn xóa chính mình
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Bạn không thể tự xóa chính mình!');
        }

        // Xóa user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User đã được xóa thành công!');
    }
}