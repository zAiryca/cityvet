@extends('layouts.app')

@section('title', '| Home')

@section('content')
<div class="bg-gray-50">
  <div class="container px-6 py-12 mx-auto max-w-7xl">
    <div class="grid items-start gap-8 lg:grid-cols-[1.3fr,0.9fr]">
      <div class="space-y-6">
        <img src="{{ asset('image/overall.png') }}" alt="Overall Logo" class="w-40 h-auto">
        <h1 class="text-3xl font-extrabold leading-tight" style="font-family: 'Poppins', sans-serif;">FindFurEver - Connecting Pets with Loving Homes</h1>
        <p class="text-lg text-gray-700" style="font-family: 'Poppins', sans-serif;">Use the City Vet system to adopt pets, claim impounded animals, report lost or found pets, and register your own pet with proof of ownership.</p>

        <div class="grid gap-6">
          <div class="p-6 bg-white rounded-3xl shadow-lg border border-gray-200">
            <h2 class="text-xl font-bold">Adopt a Pet & Impounded Pets</h2>
            <p class="mt-3 text-gray-600">Browse animals available for adoption, or view impounded pets that may be reunited with their owners.</p>
            <ol class="mt-4 space-y-2 text-gray-700 list-decimal list-inside">
              <li>Open the adoptable or impounded pet list.</li>
              <li>Review the pet profile, photos, and status.</li>
              <li>Submit an adoption or claim request from the pet page.</li>
              <li>Complete the necessary verification and processing steps. Fees are shown on the pet request page.</li>
            </ol>
            <div class="mt-4 flex flex-wrap gap-3">
              <a href="{{ route('pets.adoptable') }}" class="px-4 py-2 text-sm font-semibold text-white rounded-lg" style="background-color:#f39c12;">Adopt a Pet</a>
              <a href="{{ route('pets.impounded') }}" class="px-4 py-2 text-sm font-semibold text-white rounded-lg" style="background-color:#f13252;">Impounded Pets</a>
            </div>
          </div>

          <div class="p-6 bg-white rounded-3xl shadow-lg border border-gray-200">
            <h2 class="text-xl font-bold">Lost & Found</h2>
            <p class="mt-3 text-gray-600">Search lost and found reports, or create a new report if you found a pet or lost yours.</p>
            <ol class="mt-4 space-y-2 text-gray-700 list-decimal list-inside">
              <li>Search the Lost & Found listings for matching pets.</li>
              <li>If you have details, submit a new lost or found report.</li>
              <li>Include a clear photo, location, and pet description.</li>
              <li>Monitor the listing for updates and owner contact.</li>
            </ol>
            <div class="mt-4 flex flex-wrap gap-3">
              <a href="{{ route('posters.index') }}" class="px-4 py-2 text-sm font-semibold text-white rounded-lg" style="background-color:#23bd04;">Lost & Found Listings</a>
              <a href="{{ route('posters.create') }}" class="px-4 py-2 text-sm font-semibold text-white rounded-lg" style="background-color:#6b21a8;">Report Lost/Found</a>
            </div>
          </div>

          <div class="p-6 bg-white rounded-3xl shadow-lg border border-gray-200">
            <h2 class="text-xl font-bold">Register Your Pet</h2>
            <p class="mt-3 text-gray-600">Register your pet with proof of ownership, so you have stronger documentation if your pet is ever lost.</p>
            <ol class="mt-4 space-y-2 text-gray-700 list-decimal list-inside">
              <li>Open the pet registration form.</li>
              <li>Complete the pet details, upload a photo, and attach ownership proof.</li>
              <li>Submit the request and wait for verification.</li>
              <li>Keep your registration record for faster lost-pet recovery.</li>
            </ol>
            <div class="mt-4">
              <a href="{{ route('pet-registrations.create') }}" class="px-4 py-2 text-sm font-semibold text-white rounded-lg" style="background-color:#2563eb;">Register Your Pet</a>
            </div>
          </div>
        </div>
      </div>

      <div class="p-8 bg-white rounded-3xl shadow-xl border border-gray-200">
        <h2 class="text-2xl font-bold">How It Works</h2>
        <p class="mt-4 text-gray-600">This homepage gives you quick access to the core actions that help keep pets safe and owners connected.</p>
        <div class="mt-6 space-y-5">
          <div>
            <h3 class="font-semibold">Fast action</h3>
            <p class="text-gray-700">Use the buttons to go directly to adoption, impound, lost/found reporting, or pet registration.</p>
          </div>
          <div>
            <h3 class="font-semibold">Clear proof of ownership</h3>
            <p class="text-gray-700">Pet registration is the strongest evidence you can present if your pet goes missing.</p>
          </div>
          <div>
            <h3 class="font-semibold">Announcements</h3>
            <p class="text-gray-700">Read important updates from the City Veterinary Office below, then open the details to return here.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="px-4 py-8 mx-auto max-w-7xl">
    <!-- Flash Messages -->
    @if(session('success'))
      <div class="px-4 py-3 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg" role="alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="px-4 py-3 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg" role="alert">{{ session('error') }}</div>
    @endif

    <!-- Announcements -->
    <div class="mb-12">
      <h2 class="mb-4 text-2xl font-bold">Latest Announcements</h2>
      @if($announcements->count() > 0)
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          @foreach($announcements as $announcement)
            <div class="p-4 bg-white border rounded-lg shadow-sm">
              <h3 class="text-lg font-semibold">{{ $announcement->title }}</h3>
              <p class="mt-2 text-sm text-gray-600">{{ Str::limit($announcement->description, 220) }}</p>
              <div class="flex items-center justify-between mt-3">
                <span class="text-xs text-gray-500">{{ $announcement->date_when }}</span>
                <a href="{{ route('announcements.show', $announcement) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">View</a>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-6 text-center">
          <a href="{{ route('announcements.index') }}" class="px-4 py-2 font-bold text-white bg-indigo-600 rounded hover:bg-indigo-700">View More Announcements</a>
        </div>
      @else
        <p class="text-gray-500">No announcements at this time.</p>
      @endif
    </div>
  </div>
</div>

@endsection
