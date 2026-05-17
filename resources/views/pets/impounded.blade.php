@extends('layouts.app')

@section('title', '| Impounded Pets')

@section('content')
<div class="px-4 py-6 pt-24 mx-auto max-w-7xl" style="font-family: Georgia, serif;">
    <h1 class="mb-6 text-3xl font-bold"><span style="color: rgb(241, 50, 82)">Impounded </span> Pets</h1>
    <p class="mb-6">Help reunite pets with their owners. These pets are waiting to be claimed.</p>

    @livewire('impounded-pet-search-filter')
</div>
@endsection
