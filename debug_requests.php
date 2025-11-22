<?php
// Debug script to check request status
require __DIR__ . '/bootstrap/app.php';

use App\Models\Pet;
use App\Models\PetRequest;
use App\Models\User;

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Check all pet requests
echo "=== ALL PET REQUESTS ===\n";
$requests = PetRequest::with(['user', 'requestable'])->get();
foreach ($requests as $req) {
    $pet = $req->requestable;
    $petName = $pet ? $pet->display_code : 'N/A';
    echo "ID: {$req->id} | Pet: {$petName} | Type: {$req->type} | Status: {$req->status} | User: {$req->user->email}\n";
}

echo "\n=== PETS WITH ADOPTED/CLAIMED STATUS ===\n";
$adoptedPets = Pet::whereIn('status', ['adopted', 'claimed'])->with('user')->get();
foreach ($adoptedPets as $pet) {
    $owner = $pet->user ? $pet->user->email : 'No owner';
    echo "Pet: {$pet->display_code} | Status: {$pet->status} | Owner (user_id: {$pet->user_id}): {$owner}\n";
}

echo "\n=== IMPOUNDED PETS ===\n";
$impounded = Pet::where('status', 'impounded')->get();
foreach ($impounded as $pet) {
    echo "Pet: {$pet->display_code} | Remaining Days: {$pet->remaining_days}\n";
}

echo "\n=== ADOPTABLE PETS ===\n";
$adoptable = Pet::where('status', 'adoptable')->limit(3)->get();
foreach ($adoptable as $pet) {
    echo "Pet: {$pet->display_code}\n";
}

echo "\nDone!\n";
?>
