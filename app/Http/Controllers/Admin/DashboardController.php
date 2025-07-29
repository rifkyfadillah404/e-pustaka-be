<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $totalBooks = Book::count();
        $totalUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->count();
        $totalCategories = Category::count();
        // Calculate available books (not currently borrowed)
        $borrowedBookIds = Peminjaman::where('status', 'approved')->pluck('books_id');
        $availableBooks = Book::whereNotIn('id', $borrowedBookIds)->count();

        // Get books by category for chart
        $booksByCategory = Category::withCount('books')
            ->orderBy('books_count', 'desc')
            ->limit(5)
            ->get();

        // Get recent books (last 7 days)
        $recentBooks = Book::with('category')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent users (last 7 days)
        $recentUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get monthly statistics for chart (last 6 months)
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'books' => Book::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'users' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'user');
                })
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            ];
        }

        // Get top categories with most books
        $topCategories = Category::withCount('books')
            ->having('books_count', '>', 0)
            ->orderBy('books_count', 'desc')
            ->limit(3)
            ->get();

        // Calculate growth percentages
        $lastMonthBooks = Book::where('created_at', '>=', Carbon::now()->subMonth())
            ->count();
        $previousMonthBooks = Book::where('created_at', '>=', Carbon::now()->subMonths(2))
            ->where('created_at', '<', Carbon::now()->subMonth())
            ->count();

        $booksGrowth = $previousMonthBooks > 0
            ? round((($lastMonthBooks - $previousMonthBooks) / $previousMonthBooks) * 100, 1)
            : 0;

        $lastMonthUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->count();
        $previousMonthUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })
            ->where('created_at', '>=', Carbon::now()->subMonths(2))
            ->where('created_at', '<', Carbon::now()->subMonth())
            ->count();

        $usersGrowth = $previousMonthUsers > 0
            ? round((($lastMonthUsers - $previousMonthUsers) / $previousMonthUsers) * 100, 1)
            : 0;

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalUsers',
            'totalCategories',
            'availableBooks',
            'booksByCategory',
            'recentBooks',
            'recentUsers',
            'monthlyStats',
            'topCategories',
            'booksGrowth',
            'usersGrowth'
        ));
    }

    public function getChartData()
    {
        // API endpoint for chart data
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'books' => Book::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'users' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'user');
                })
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $monthlyStats
        ]);
    }
}
