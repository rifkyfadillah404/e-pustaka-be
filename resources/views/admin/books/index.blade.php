@extends('layouts.app')

@section('title', 'Books - E-Pustaka Admin')
@section('page-title', 'Books')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">Books</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Books List</h3>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                Add New Book
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books ?? [] as $book)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($book->image ?? false)
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $book->image)) }}" 
                                             alt="{{ $book->title }}" class="me-3" style="width: 40px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="symbol symbol-40px me-3" style="background-color: #009ef7;">
                                            <span class="text-white fw-bold">{{ strtoupper(substr($book->title ?? 'Book', 0, 2)) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $book->title ?? 'Sample Book Title' }}</strong><br>
                                        @if($book->rack ?? false)
                                            <small class="text-muted">Rack: {{ $book->rack }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $book->author ?? 'Sample Author' }}</td>
                            <td>{{ $book->publisher ?? 'Sample Publisher' }}</td>
                            <td>{{ $book->year ?? '2024' }}</td>
                            <td>
                                <span class="badge badge-primary">
                                    {{ $book->category->name ?? 'Fiction' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ ($book->quantity ?? 10) > 0 ? 'success' : 'danger' }}">
                                    {{ $book->quantity ?? 10 }} pcs
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.books.edit', $book->id ?? 1) }}" class="btn btn-sm btn-primary me-2">
                                    Edit
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.books.destroy', $book->id ?? 1) }}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p>No books found.</p>
                                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                                    Add First Book
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(url) {
            if (confirm('Are you sure you want to delete this book?')) {
                // Create form and submit
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                // Get fresh CSRF token from meta tag
                var csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                var methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endpush
