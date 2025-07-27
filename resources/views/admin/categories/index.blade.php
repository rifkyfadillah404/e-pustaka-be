@extends('layouts.app')

@section('title', 'Categories - E-Pustaka Admin')
@section('page-title', 'Categories')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">Categories</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Categories List</h3>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                Add New Category
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories ?? [] as $category)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <strong>{{ $category->name ?? 'Fiction' }}</strong><br>
                                        <small class="text-muted">{{ $category->books_count ?? 0 }} books</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $category->id ?? 1) }}"
                                    class="btn btn-sm btn-primary me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-sm btn-danger"
                                    onclick="confirmDelete('{{ route('admin.categories.destroy', $category->id ?? 1) }}')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-4">
                                <p>No categories found.</p>
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                    Add First Category
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
            if (confirm('Are you sure you want to delete this category?')) {
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
