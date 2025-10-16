@extends('layouts.app')

@section('title', '| FAQ')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Frequently Asked Questions</h1>
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-2 cursor-pointer" onclick="toggleFaq(this)">What is the impound hold period?</h2>
            <p class="text-gray-700 hidden mt-2">Pets are held for 7 days before becoming adoptable. Contact us immediately to claim!</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-2 cursor-pointer" onclick="toggleFaq(this)">How do I adopt a pet?</h2>
            <p class="text-gray-700 hidden mt-2">Browse adoptable pets, submit a request with your info. We'll review and contact you for an interview.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-2 cursor-pointer" onclick="toggleFaq(this)">Can I post a lost pet poster?</h2>
            <p class="text-gray-700 hidden mt-2">Yes, login and create a poster. It will be reviewed for approval within 24 hours.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-2 cursor-pointer" onclick="toggleFaq(this)">What events can I attend?</h2>
            <p class="text-gray-700 hidden mt-2">Family-friendly adoption fairs, vet workshops, and more. Register your pet to join.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-2 cursor-pointer" onclick="toggleFaq(this)">How to donate?</h2>
            <p class="text-gray-700 hidden mt-2">Use our donate page for secure contributions. All donations are tax-deductible.</p>
        </div>
    </div>
    <a href="{{ route('contact') }}" class="block mt-8 text-center bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 w-48 mx-auto">Still Have Questions? Contact Us</a>
</div>

<script>
function toggleFaq(element) {
    const p = element.nextElementSibling;
    p.classList.toggle('hidden');
}
</script>
@endsection
