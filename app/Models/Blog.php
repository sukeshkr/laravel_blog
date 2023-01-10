<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_date',
        'title',
        'category',
        'description',
        'file',
    ];

    public function categorys()
    {
        return $this->belongsTo(Category::class,'category');
    }
}
