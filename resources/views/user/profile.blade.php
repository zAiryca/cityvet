@extends('layouts.app')

@section('title', '| Profile')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">My Profile</h1>

    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-green-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-green-800">Adopted Pets</h3>
            <p class="text-3xl font-bold">{{ $user->adoptedPets()->count() }}</p>
            <a href="#adopted-pets" class="text-green-600 hover:underline">View Adopted</a>
        </div>
        <div class="bg-blue-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-blue-800">Claimed Pets</h3>
            <p class="text-3xl font-bold">{{ $user->claimedPets()->count() }}</p>
            <a href="#claimed-pets" class="text-blue-600 hover:underline">View Claimed</a>
        </div>

        <div class="bg-yellow-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-yellow-800">Pending Requests</h3>
            <p class="text-3xl font-bold">{{ $user->requests()->where('status', 'pending')->count() }}</p>
            <a href="{{ route('user.requests') }}" class="text-yellow-600 hover:underline">View Requests</a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="#update-info" class="bg-blue-600 text-white p-4 rounded text-center hover:bg-blue-700">Update Personal Info</a>
            <a href="#change-password" class="bg-red-600 text-white p-4 rounded text-center hover:bg-red-700">Change Password</a>
            <a href="{{ route('posters.create') }}" class="bg-purple-600 text-white p-4 rounded text-center hover:bg-purple-700">Post Lost/Found</a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow mb-8" id="update-info">
        <h2 class="text-xl font-bold mb-4">Update Personal Information</h2>
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="bg-white p-6 rounded-lg shadow mb-8" id="change-password">
        <h2 class="text-xl font-bold mb-4">Change Password</h2>
        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="current_password" :value="__('Current Password')" />
                <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>Update Password</x-primary-button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Adopted Pets List -->
        <div id="adopted-pets">
            <h2 class="text-xl font-bold mb-4">My Adopted Pets</h2>
            @if($user->adoptedPets->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    @foreach($user->adoptedPets as $pet)
                        <div class="bg-green-50 p-4 rounded-lg shadow-sm border-l-4 border-green-500">
                            <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/100?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-24 object-cover rounded mb-2">
                            <h3 class="font-bold">{{ $pet->name }}</h3>
                            <p class="text-gray-600">{{ $pet->species }} - {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-500">{{ Str::limit($pet->description, 50) }}</p>
                            <p class="text-sm text-green-600 font-medium">Adopted on {{ $pet->updated_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 mb-6">No adopted pets yet.</p>
            @endif
        </div>

        <!-- Claimed Pets List -->
        <div id="claimed-pets">
            <h2 class="text-xl font-bold mb-4">My Claimed Pets</h2>
            @if($user->claimedPets->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    @foreach($user->claimedPets as $pet)
                        <div class="bg-blue-50 p-4 rounded-lg shadow-sm border-l-4 border-blue-500">
                            <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/100?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-24 object-cover rounded mb-2">
                            <h3 class="font-bold">{{ $pet->name }}</h3>
                            <p class="text-gray-600">{{ $pet->species }} - {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-500">{{ Str::limit($pet->description, 50) }}</p>
                            <p class="text-sm text-blue-600 font-medium">Claimed on {{ $pet->updated_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 mb-6">No claimed pets yet.</p>
            @endif
        </div>

        <!-- Registered Pets List -->
        <div>
            <h2 class="text-xl font-bold mb-4">My Registered Pets</h2>
            @if($pets->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    @foreach($pets as $pet)
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/100?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-24 object-cover rounded mb-2">
                            <h3 class="font-bold">{{ $pet->name }}</h3>
                            <p class="text-gray-600">{{ $pet->species }} - {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-500">{{ Str::limit($pet->description, 50) }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 mb-6">No registered pets yet. Register one below to use for announcements or adoptions!</p>
            @endif
        </div>

        <!-- Register New Pet Form -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Register a New Pet</h2>
            <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Species</label>
                        <select name="species" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror">
                            <option value="">Select Species</option>
                            <option value="Canine" {{ old('species') === 'Canine' ? 'selected' : '' }}>Canine</option>
                            <option value="Feline" {{ old('species') === 'Feline' ? 'selected' : '' }}>Feline</option>
                        </select>
                        @error('species') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Breed</label>
                        <select name="breed" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror">
                            <option value="">Select Breed</option>
                            <option value="Persian" {{ old('breed') === 'Persian' ? 'selected' : '' }}>Persian</option>
                            <option value="Siamese" {{ old('breed') === 'Siamese' ? 'selected' : '' }}>Siamese</option>
                            <option value="Maine Coon" {{ old('breed') === 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                            <option value="British Shorthair" {{ old('breed') === 'British Shorthair' ? 'selected' : '' }}>British Shorthair</option>
                            <option value="Ragdoll" {{ old('breed') === 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                            <option value="Bengal" {{ old('breed') === 'Bengal' ? 'selected' : '' }}>Bengal</option>
                            <option value="Sphynx" {{ old('breed') === 'Sphynx' ? 'selected' : '' }}>Sphynx</option>
                            <option value="Abyssinian" {{ old('breed') === 'Abyssinian' ? 'selected' : '' }}>Abyssinian</option>
                            <option value="Scottish Fold" {{ old('breed') === 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                            <option value="Russian Blue" {{ old('breed') === 'Russian Blue' ? 'selected' : '' }}>Russian Blue</option>
                            <option value="Aspin" {{ old('breed') === 'Aspin' ? 'selected' : '' }}>Aspin</option>
                            <option value="Puspin" {{ old('breed') === 'Puspin' ? 'selected' : '' }}>Puspin</option>
                            <option value="Shih Tzu" {{ old('breed') === 'Shih Tzu' ? 'selected' : '' }}>Shih Tzu</option>
                            <option value="Poodle" {{ old('breed') === 'Poodle' ? 'selected' : '' }}>Poodle</option>
                            <option value="Golden Retriever" {{ old('breed') === 'Golden Retriever' ? 'selected' : '' }}>Golden Retriever</option>
                            <option value="Labrador" {{ old('breed') === 'Labrador' ? 'selected' : '' }}>Labrador</option>
                            <option value="German Shepherd" {{ old('breed') === 'German Shepherd' ? 'selected' : '' }}>German Shepherd</option>
                            <option value="Bulldog" {{ old('breed') === 'Bulldog' ? 'selected' : '' }}>Bulldog</option>
                            <option value="Beagle" {{ old('breed') === 'Beagle' ? 'selected' : '' }}>Beagle</option>
                            <option value="Chihuahua" {{ old('breed') === 'Chihuahua' ? 'selected' : '' }}>Chihuahua</option>
                        </select>
                        @error('breed') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3" placeholder="About your pet..." class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="unknown" {{ old('gender') === 'unknown' ? 'selected' : '' }}>Unknown</option>
                    </select>
                    @error('gender') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                    @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Register Pet</button>
            </form>
        </div>
    </div>
</div>
@endsection
