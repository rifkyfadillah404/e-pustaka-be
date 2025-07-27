<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('user', 'book')->get();
        return view('admin.peminjaman.index');
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => 'approved'
        ]);
        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman approved successfully');
    }
}
