<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'book_code',
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

    /**
     * Generate unique book code
     * Format: BK-YYYY-XXXX (e.g., BK-2025-0001)
     */
    public static function generateBookCode()
    {
        $year = date('Y');
        $prefix = 'BK-' . $year . '-';

        // Get the last book code for current year
        $lastBook = self::where('book_code', 'like', $prefix . '%')
            ->orderBy('book_code', 'desc')
            ->first();

        if ($lastBook) {
            // Extract the number part and increment
            $lastNumber = (int) substr($lastBook->book_code, -4);
            $newNumber = $lastNumber + 1;
        } else {
            // First book of the year
            $newNumber = 1;
        }

        // Format with leading zeros (4 digits)
        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
