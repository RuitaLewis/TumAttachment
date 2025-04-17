<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'file_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
