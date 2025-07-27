@extends('layouts.app')

@section('title', 'Users - E-Pustaka Admin')
@section('page-title', 'Users')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">Users</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Users List</h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                Add New User
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <strong>{{ $user->name ?? 'Sample User' }}</strong><br>
                                        <small class="text-muted">ID: {{ $user->id ?? 1 }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email ?? 'user@example.com' }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $user->roles->first()->name ?? 'user' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '26 Jul 2024' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $user->id ?? 1) }}"
                                    class="btn btn-sm btn-primary me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-sm btn-danger"
                                    onclick="confirmDelete('{{ route('admin.users.destroy', $user->id ?? 1) }}')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <p>No users found.</p>
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                    Add First User
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
            if (confirm('Are you sure you want to delete this user?')) {
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
