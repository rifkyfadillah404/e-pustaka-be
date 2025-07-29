<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return redirect()->route('admin.peminjaman.index')
                ->with('error', 'Only pending requests can be approved');
        }

        $peminjaman->update([
            'status' => 'approved',
            'tanggal_pinjam' => Carbon::now()->format('Y-m-d')
        ]);



        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman approved successfully');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return redirect()->route('admin.peminjaman.index')
                ->with('error', 'Only pending requests can be rejected');
        }

        $peminjaman->update([
            'status' => 'reject'
        ]);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman rejected successfully');
    }

    public function return($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'approved') {
            return redirect()->route('admin.peminjaman.index')
                ->with('error', 'Only approved books can be returned');
        }

        $peminjaman->update([
            'status' => 'returned',
            'tanggal_kembali' => Carbon::now()->format('Y-m-d')
        ]);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Book returned successfully');
    }
}
