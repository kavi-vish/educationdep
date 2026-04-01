@extends('layouts.app')

@section('content')
<div class="flex">
    {{-- Sidebar --}}
    @include('accountant.partials.sidebar')

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