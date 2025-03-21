<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    // Hiển thị form nộp bài
    public function create(Assignment $assignment)
    {
        return view('submissions.create', compact('assignment'));
    }

    // Lưu bài làm
    public function store(Request $request, Assignment $assignment)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,docx,txt,zip|max:2048',
        ]);

        $filePath = $request->file('file')->store('submissions','public');

        Submission::create([
            'assignment_id' => $assignment->id,
            'user_id' => Auth::id(),
            'file_path' => $filePath,
        ]);

        return redirect()->route('assignments.index')->with('success', 'Bài làm đã được nộp!');
    }

    // Danh sách bài làm (chỉ admin)
    public function index(Assignment $assignment)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('assignments.index')->with('error', 'Bạn không có quyền!');
        }

        $submissions = $assignment->submissions;
        return view('submissions.index', compact('assignment', 'submissions'));
    }
}
