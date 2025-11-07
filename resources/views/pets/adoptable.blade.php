@extends('layouts.app')

@section('title', '| Adoptable Pets')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Adoptable Pets</h1>
    <p class="mb-6">Find your new best friend! These pets are ready for adoption.</p>

    @livewire('pet-search-filter')
</div>
@endsection
