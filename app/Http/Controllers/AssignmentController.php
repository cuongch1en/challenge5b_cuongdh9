<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    // Hiển thị danh sách bài tập
    public function index()
    {
        $assignments = Assignment::latest()->get();
        return view('assignments.index', compact('assignments'));
    }

    // Hiển thị form upload bài tập (chỉ admin)
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('assignments.index')->with('error', 'Bạn không có quyền!');
        }
        return view('assignments.create');
    }

    // Lưu bài tập
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,txt,docx,zip|max:2048',
        ]);

        $filePath = $request->file('file')->store('assignments','public');

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('assignments.index')->with('success', 'Bài tập đã được tải lên!');
    }

    // Tải file bài tập
    public function download(Assignment $assignment)
    {
        return Storage::download($assignment->file_path);
    }
}

