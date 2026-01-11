@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
<div class="flex">
    @include('admin.partials.sidebar')

    <div class="flex-grow-1 p-4 bg-light" style="min-height: 100vh;">
        <div class="container-fluid">

            {{-- Header --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i> Add New User</h4>
                </div>
            </div>

            {{-- Form --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Full name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="user@example.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="••••••••" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation"
                                   class="form-control" placeholder="••••••••" required>
                        </div>

                        {{-- Role (exact DB values) --}}
                        <div class="mb-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">-- Select Role --</option>
                                @foreach(['admin', 'zonal director', 'accountant', 'user'] as $role)
                                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $role)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Zone (optional) --}}
                        <div class="mb-3">
                            <label class="form-label">Zone</label>
                            <select name="zone_id" class="form-select">
                                <option value="">-- No Zone --</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>
                                        {{ $zone->zone_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Create User
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsections