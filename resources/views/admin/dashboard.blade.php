@extends('layouts.app')

@section('content')
<div class="flex">
    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Content --}}
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @auth
    <h1 class="text-lg font-semibold text-blue-800">
        Welcome, {{ Auth::user()->name }}!
    </h1>
@endauth
                </div>
            </div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    @foreach(\App\Models\Vote::all() as $vote)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold">Vote {{ $vote->vote_number }}</h3>
        <p class="text-3xl font-bold text-{{ $vote->remaining < 0 ? 'red' : 'green' }}-600 mt-4">
            Rs. {{ number_format($vote->remaining, 2) }}
        </p>
        <p class="text-sm text-gray-600">Remaining Balance</p>
    </div>
    @endforeach
</div>

@endsection
