<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'image',
        'year',
        'rack',
        'category_id',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
