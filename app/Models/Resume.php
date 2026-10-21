<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'original_filename',
        'file_path',
        'extracted_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
