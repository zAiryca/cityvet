@extends('layouts.admin')

@section('title', '| Admin - Reports')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Generate Reports</h1>
    <p class="mb-6">View key metrics and export data for analysis.</p>


    </div>

    <!-- Export -->
    <form action="{{ route('admin.reports.export') }}" method="POST" class="inline">  <!-- Add this route for PDF/CSV -->
        @csrf
        <select name="format" class="p-2 mr-2 border rounded">
            <option value="pdf">PDF</option>
            <option value="csv">CSV</option>
        </select>
        <button type="submit" class="px-6 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">Export Report</button>
    </form>
    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 ml-4 text-white bg-blue-600 rounded hover:bg-blue-700">Back to Dashboard</a>
</div>
@endsection
