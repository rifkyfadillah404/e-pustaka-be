@extends('layouts.app')

@section('title', 'Peminjaman Management - E-Pustaka Admin')
@section('page-title', 'Peminjaman Management')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">Peminjaman</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Peminjaman Requests</h3>
            <div class="d-flex gap-2">
                <span class="badge badge-warning">{{ $peminjaman->where('status', 'pending')->count() }} Pending</span>
                <span class="badge badge-success">{{ $peminjaman->where('status', 'approved')->count() }} Approved</span>
                <span class="badge badge-danger">{{ $peminjaman->where('status', 'reject')->count() }} Rejected</span>
                <span class="badge badge-info">{{ $peminjaman->where('status', 'returned')->count() }} Returned</span>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Book</th>
                            <th>Request Date</th>
                            <th>Borrow Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-35px me-3"
                                            style="background-color: #009ef7;">
                                            <span
                                                class="text-white fw-bold fs-8">{{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <strong>{{ $item->user->name ?? 'Unknown User' }}</strong><br>
                                            <small class="text-muted">{{ $item->user->email ?? 'No email' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-35px me-3"
                                            style="background-color: #17C653;">
                                            <span
                                                class="text-white fw-bold fs-8">{{ strtoupper(substr($item->book->book_code ?? 'BK', 0, 2)) }}</span>
                                        </div>
                                        <div>
                                            <strong>{{ $item->book->book_code ?? 'Unknown Code' }}</strong><br>
                                            <small class="text-muted">{{ $item->book->title ?? 'Unknown Book' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $item->created_at->format('d M Y') }}</span><br>
                                    <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    @if ($item->tanggal_pinjam)
                                        <span
                                            class="text-success">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->tanggal_kembali)
                                        <span
                                            class="text-info">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($item->status)
                                        @case('pending')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                        @break

                                        @case('approved')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check"></i> Approved
                                            </span>
                                        @break

                                        @case('reject')
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times"></i> Rejected
                                            </span>
                                        @break

                                        @case('returned')
                                            <span class="badge badge-info">
                                                <i class="fas fa-undo"></i> Returned
                                            </span>
                                        @break

                                        @default
                                            <span class="badge badge-secondary">{{ $item->status }}</span>
                                    @endswitch
                                </td>
                                <td class="text-end">
                                    @if ($item->status === 'pending')
                                        <a href="{{ route('admin.peminjaman.approve', $item->id) }}"
                                            class="btn btn-sm btn-success me-2"
                                            onclick="return confirm('Approve this borrowing request?')">
                                            <i class="fas fa-check"></i> Approve
                                        </a>
                                        <a href="{{ route('admin.peminjaman.reject', $item->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Reject this borrowing request?')">
                                            <i class="fas fa-times"></i> Reject
                                        </a>
                                    @elseif($item->status === 'approved')
                                        <a href="{{ route('admin.peminjaman.return', $item->id) }}"
                                            class="btn btn-sm btn-info"
                                            onclick="return confirm('Mark this book as returned?')">
                                            <i class="fas fa-undo"></i> Return
                                        </a>
                                    @else
                                        <span class="text-muted">No actions</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-book-open fa-3x mb-3"></i>
                                            <h5>No Peminjaman Requests</h5>
                                            <p>There are no borrowing requests yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
