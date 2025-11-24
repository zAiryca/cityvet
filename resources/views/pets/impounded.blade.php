@extends('layouts.app')

@section('title', '| Impounded Pets')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Impounded Pets</h1>
    <p class="mb-6">Help reunite pets with their owners. These pets are waiting to be claimed.</p>

    @livewire('impounded-pet-search-filter')
</div>
@endsection
