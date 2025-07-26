@extends('layouts.app')

@section('title', 'Edit Category - E-Pustaka Admin')
@section('page-title', 'Edit Category')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="/admin/categories" class="text-muted text-hover-primary">Categories</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">{{ $category->name ?? 'Edit Category' }}</li>
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id ?? 1) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label required">Category Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter category name" value="{{ old('name', $category->name ?? 'Fiction') }}"
                                required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-light me-3">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
