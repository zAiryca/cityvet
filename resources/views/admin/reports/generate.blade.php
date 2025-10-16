@extends('layouts.app')

@section('title', '| Admin - Reports')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Generate Reports</h1>
    <p class="mb-6">View key metrics and export data for analysis.</p>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-blue-800">Total Pets</h3>
            <p class="text-3xl font-bold">{{ $stats['total_pets'] ?? Pet::count() }}</p>
        </div>
        <div class="bg-green-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-green-800">Adoptions This Month</h3>
            <p class="text-3xl font-bold">{{ $stats['monthly_adoptions'] ?? Pet::whereMonth('adoptable_date', now())->count() }}</p>
        </div>
        <div class="bg-purple-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-purple-800">Total Events</h3>
            <p class="text-3xl font-bold">{{ $stats['total_events'] ?? Event::count() }}</p>
        </div>
        <div class="bg-yellow-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-yellow-800">Pending Requests</h3>
            <p class="text-3xl font-bold">{{ $stats['pending_requests'] ?? PetRequest::where('status', 'pending')->count() }}</p>
        </div>
    </div>

    <!-- Monthly Stats Table -->
    <div class="bg-white rounded-lg shadow mb-8">
        <h2 class="p-6 text-xl font-bold border-b">Monthly Adoption Trends</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Month</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Impounded</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Adopted</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Events Held</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($stats['monthly_data'] ?? [] as $month => $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $month }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data['impounded'] ?? 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data['adopted'] ?? 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data['events'] ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart Placeholder -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h2 class="text-xl font-bold mb-4">Adoption Chart</h2>
        <div class="bg-gray-200 h-64 rounded flex items-center justify-center">
            <p class="text-gray-500">Chart.js or Google Charts Embed Here<br>(e.g., Bar chart of monthly adoptions)</p>
        </div>
    </div>

    <!-- Export -->
    <form action="{{ route('admin.reports.export') }}" method="POST" class="inline">  <!-- Add this route for PDF/CSV -->
        @csrf
        <select name="format" class="border p-2 rounded mr-2">
            <option value="pdf">PDF</option>
            <option value="csv">CSV</option>
        </select>
        <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">Export Report</button>
    </form>
    <a href="{{ route('admin.dashboard') }}" class="ml-4 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Back to Dashboard</a>
</div>
@endsection
