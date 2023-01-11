<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;


class Category extends Model
{
    use HasFactory ,Cachable;

    protected $fillable = [
        'name',
        'file',
        'description'
    ];
    public function blogs()
    {
        return $this->hasMany(Blog::class,'category','id');
    }
}
