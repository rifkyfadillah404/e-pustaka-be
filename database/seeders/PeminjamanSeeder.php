<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\Category;
use Spatie\Permission\Models\Role;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        // Create sample user if not exists
        $user = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password')
            ]
        );

        // Assign user role
        $userRole = Role::firstOrCreate(['name' => 'user']);
        if (!$user->hasRole('user')) {
            $user->assignRole('user');
        }

        // Create sample category if not exists
        $category = Category::firstOrCreate(['name' => 'Fiction']);

        // Create sample books
        $book1 = Book::firstOrCreate(
            ['book_code' => 'BK-2025-0001'],
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'publisher' => 'Bloomsbury',
                'year' => '1997',
                'rack' => 'A-01',
                'category_id' => $category->id,
                'quantity' => 1
            ]
        );

        $book2 = Book::firstOrCreate(
            ['book_code' => 'BK-2025-0002'],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'Allen & Unwin',
                'year' => '1954',
                'rack' => 'A-02',
                'category_id' => $category->id,
                'quantity' => 1
            ]
        );

        $book3 = Book::firstOrCreate(
            ['book_code' => 'BK-2025-0003'],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'Allen & Unwin',
                'year' => '1937',
                'rack' => 'A-03',
                'category_id' => $category->id,
                'quantity' => 1
            ]
        );

        // Create sample peminjaman with different statuses
        Peminjaman::firstOrCreate([
            'user_id' => $user->id,
            'books_id' => $book1->id,
            'quantity' => 1,
            'status' => 'pending',
            'tanggal_pinjam' => null,
            'tanggal_kembali' => null
        ]);

        Peminjaman::firstOrCreate([
            'user_id' => $user->id,
            'books_id' => $book2->id,
            'quantity' => 1,
            'status' => 'approved',
            'tanggal_pinjam' => '2025-01-20',
            'tanggal_kembali' => null
        ]);

        Peminjaman::firstOrCreate([
            'user_id' => $user->id,
            'books_id' => $book3->id,
            'quantity' => 1,
            'status' => 'returned',
            'tanggal_pinjam' => '2025-01-15',
            'tanggal_kembali' => '2025-01-25'
        ]);

        echo "Peminjaman sample data created successfully!\n";
    }
}
