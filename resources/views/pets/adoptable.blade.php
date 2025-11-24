@extends('layouts.app')

@section('title', '| Adoptable Pets')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Adoptable Pets</h1>
    <p class="mb-6">Find your new best friend! These pets are ready for adoption.</p>

    @livewire('adoptable-pet-search-filter')
</div>
@endsection
