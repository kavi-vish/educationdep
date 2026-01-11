@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="flex">
    @include('admin.partials.sidebar')

    <div class="flex-grow-1 p-4 bg-light" style="min-height: 100vh;">
        <div class="container-fluid">

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i> Edit User</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">New Password (leave blank to keep)</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Role</label>
                                <select name="role" class="form-select" required>
                                    @foreach(['Admin','Zonal Director','Accountant','Assignee'] as $role)
                                        <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Zone</label>
                                <select name="zone_id" class="form-select">
                                    <option value="">-- No Zone --</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->zone_id }}" {{ old('zone_id', $user->zone_id) == $zone->zone_id ? 'selected' : '' }}>
                                            {{ $zone->zone_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Update User
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection