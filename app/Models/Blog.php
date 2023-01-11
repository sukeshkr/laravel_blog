<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Blog extends Model
{
    use HasFactory ,Cachable;

    protected $fillable = [
        'post_date',
        'title',
        'category',
        'description',
        'file',
    ];

    protected function postDate():Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d M , Y'),

        );

    }

    public function categorys()
    {
        return $this->belongsTo(Category::class,'category');
    }
}
