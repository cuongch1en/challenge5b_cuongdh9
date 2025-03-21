<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use Illuminate\Support\Str;

class ChallengeController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:txt|max:2048',
            'hint' => 'required|string',
        ]);

        // Lấy tên file gốc (bỏ đuôi .txt), chuyển thành không dấu, thay khoảng trắng thành "_"
        $originalFileName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = Str::slug($originalFileName, ' '); // Đây là đáp án

        // Lưu file vào storage
        $filePath = $request->file('file')->storeAs('challenges', $originalFileName . '.txt', 'public');

        Challenge::create([
            'hint' => $request->hint,
            'file_path' => $filePath,
        ]);

        return redirect()->route('challenges.index')->with('success', 'Challenge đã được tạo!');
    }
    public function index()
    {
        $challenges = Challenge::all();
        return view('challenges.index', compact('challenges'));
    }
    public function checkAnswer(Request $request, Challenge $challenge)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        // Lấy tên file gốc (chính là đáp án)
        $expectedAnswer = pathinfo(storage_path("app/public/{$challenge->file_path}"), PATHINFO_FILENAME);
        $expectedAnswer = Str::slug($expectedAnswer, ' ');
        // dd($expectedAnswer);
        // Chuẩn hóa đáp án của sinh viên
        $userAnswer = Str::slug($request->answer, ' ');
        // dd($userAnswer);
        if ($userAnswer === $expectedAnswer) {
            // Đọc nội dung file TXT
            $content = file_get_contents(storage_path("app/public/{$challenge->file_path}"));
            // dd($content);
            return view('challenges.result', compact('content'));
        }

        return back()->with('error', 'Đáp án chưa chính xác, thử lại!');
    }


}
