<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'file_path',
        'filename',
        'file_type',
        'file_size',
    ];
    

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
    
}
