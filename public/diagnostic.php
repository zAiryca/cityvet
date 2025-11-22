<?php

// Quick diagnostic script to test the impounded/claim workflow
// Place in public directory and access via /diagnostic.php

echo "<h1>CityVet - Impounded Pet & Claim Workflow Diagnostic</h1>";

// Load Laravel
define('LARAVEL_START', microtime(true));
require_once __DIR__ . '/../bootstrap/app.php';

use App\Models\Pet;
use App\Models\PetRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

try {
    echo "<h2>Database Connection</h2>";
    DB::connection()->getPdo();
    echo "<p style='color: green;'>✓ Database connected successfully</p>";
} catch (\Exception $e) {
    echo "<p style='color: red;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
    exit;
}

echo "<h2>Impounded Pets Status</h2>";
$impoundedCount = Pet::where('status', 'impounded')->count();
$adoptableCount = Pet::where('status', 'adoptable')->count();
$adoptedCount = Pet::where('status', 'adopted')->count();
$claimedCount = Pet::where('status', 'claimed')->count();

echo "<ul>";
echo "<li>Impounded pets: <strong>$impoundedCount</strong></li>";
echo "<li>Adoptable pets: <strong>$adoptableCount</strong></li>";
echo "<li>Adopted pets: <strong>$adoptedCount</strong></li>";
echo "<li>Claimed pets: <strong>$claimedCount</strong></li>";
echo "</ul>";

if ($impoundedCount === 0) {
    echo "<p style='color: orange;'>⚠️ No impounded pets found. Create one to test claiming.</p>";
} else {
    echo "<p style='color: green;'>✓ Impounded pets exist for testing</p>";
}

echo "<h2>Recent Pet Requests</h2>";
$requests = PetRequest::with(['user', 'requestable'])
    ->orderBy('created_at', 'desc')
    ->limit(10)
    ->get();

if ($requests->count() === 0) {
    echo "<p>No requests found yet.</p>";
} else {
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Type</th><th>Status</th><th>Pet</th><th>User</th><th>Created</th></tr>";
    foreach ($requests as $req) {
        $pet = $req->requestable;
        $petName = $pet ? ($pet->display_code ?? 'Unknown') : 'N/A';
        $userEmail = $req->user ? $req->user->email : 'Unknown';
        $created = $req->created_at->format('M d, Y H:i');
        echo "<tr><td>$req->id</td><td>$req->type</td><td>$req->status</td><td>$petName</td><td>$userEmail</td><td>$created</td></tr>";
    }
    echo "</table>";
}

echo "<h2>Pets with Adopted/Claimed Status</h2>";
$adoptedClaimedPets = Pet::whereIn('status', ['adopted', 'claimed'])
    ->with(['user', 'requests' => function ($q) {
        $q->where('status', 'completed');
    }])
    ->get();

if ($adoptedClaimedPets->count() === 0) {
    echo "<p>No adopted or claimed pets yet.</p>";
} else {
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr><th>Pet Code</th><th>Status</th><th>Owner (user_id)</th><th>Owner Email</th><th>Requests</th></tr>";
    foreach ($adoptedClaimedPets as $pet) {
        $owner = $pet->user ? $pet->user->email : 'No owner';
        $reqCount = $pet->requests ? $pet->requests->count() : 0;
        echo "<tr><td>$pet->display_code</td><td>$pet->status</td><td>$pet->user_id</td><td>$owner</td><td>$reqCount</td></tr>";
    }
    echo "</table>";
}

echo "<h2>Test Data Creation</h2>";
echo "<p>To create test data, run in tinker or artisan command:</p>";
echo "<pre>
// Create an impounded pet
\$pet = Pet::create([
    'species' => 'dog',
    'breed' => 'Labrador',
    'gender' => 'male',
    'color_markings' => 'Black',
    'description' => 'Test impounded dog',
    'status' => 'impounded',
    'impounded_date' => now(),
    'caught_location' => 'Downtown',
]);

// Create a claim request
\$user = User::first();
\$pet->requests()->create([
    'user_id' => \$user->id,
    'type' => 'claim',
    'status' => 'pending',
    'reason' => 'Test claim request',
    'additional_data' => ['first_name' => \$user->first_name, 'last_name' => \$user->last_name],
]);
</pre>";

echo "<h2>Routes</h2>";
echo "<ul>";
echo "<li><a href='/impounded'>View Impounded Pets</a></li>";
echo "<li><a href='/adoptable'>View Adoptable Pets</a></li>";
echo "<li><a href='/my-adopted-claimed-pets'>View My Adopted/Claimed Pets</a></li>";
echo "</ul>";

echo "<p><small>Last updated: " . date('Y-m-d H:i:s') . "</small></p>";
?>
