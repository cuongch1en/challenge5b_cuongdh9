<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'file_path', 'uploaded_by'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
