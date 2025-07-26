@extends('layouts.app')

@section('title', 'Add Book - E-Pustaka Admin')
@section('page-title', 'Add Book')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.books.index') }}" class="text-muted text-hover-primary">Books</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Add New</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Book</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label required">Title</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter book title"
                                    value="{{ old('title') }}" required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label required">Author</label>
                                <input type="text" name="author"
                                    class="form-control @error('author') is-invalid @enderror"
                                    placeholder="Enter author name" value="{{ old('author') }}" required />
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Publisher</label>
                                <input type="text" name="publisher"
                                    class="form-control @error('publisher') is-invalid @enderror"
                                    placeholder="Enter publisher name" value="{{ old('publisher') }}" />
                                @error('publisher')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label required">Year</label>
                                <input type="text" name="year"
                                    class="form-control @error('year') is-invalid @enderror"
                                    placeholder="Enter publication year" value="{{ old('year') }}" required />
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label required">Category</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                    required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label required">Quantity</label>
                                <input type="number" name="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    placeholder="Enter quantity" value="{{ old('quantity') }}" min="0" required />
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Rack</label>
                                <input type="text" name="rack"
                                    class="form-control @error('rack') is-invalid @enderror"
                                    placeholder="Enter rack location (e.g., A-01)" value="{{ old('rack') }}" />
                                @error('rack')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Book Image</label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*" />
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Upload book cover image (optional)</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.books.index') }}" class="btn btn-light me-3">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Save Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
