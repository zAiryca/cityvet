@extends('layouts.app')

@section('title', '| Donate')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Support CityVet</h1>
    <p class="mb-6 text-gray-700">Your donations help us care for impounded pets, host events, and reunite families. Every dollar makes a difference!</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Why Donate?</h2>
            <ul class="text-gray-700 space-y-2">
                <li>• Food and medical care for 500+ pets yearly</li>
                <li>• Free adoption events and workshops</li>
                <li>• Lost & found poster printing and distribution</li>
                <li>• Tax-deductible contributions</li>
            </ul>
            <p class="mt-4 text-green-600 font-bold">$50 feeds a pet for a month!</p>
        </div>

        <!-- Donation Form (Placeholder) -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Make a Donation</h2>
            <form action="#" method="POST" class="space-y-4">  <!-- Integrate payment gateway -->
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount ($)</label>
                    <select name="amount" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                        <option value="25">$25</option>
                        <option value="50">$50</option>
                        <option value="100">$100</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                <div id="custom-amount" style="display:none;">
                    <input type="number" name="custom_amount" placeholder="Enter amount" class="block w-full border border-gray-300 rounded-md p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded hover:bg-green-700">Donate Now</button>
            </form>
            <p class="mt-4 text-sm text-gray-500">Secure payment via [PayPal/Stripe]. Questions? <a href="{{ route('contact') }}" class="text-blue-600">Contact us</a>.</p>
        </div>
    </div>
</div>

<script>
document.querySelector('select[name="amount"]').addEventListener('change', function() {
    document.getElementById('custom-amount').style.display = this.value === 'custom' ? 'block' : 'none';
});
</script>
@endsection
