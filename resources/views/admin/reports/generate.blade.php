@extends('layouts.admin')

@section('title', '| Admin - Reports')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Generate Reports</h1>
    <p class="mb-6">Generate monthly reports for impounded/adoptable pets and export as PDF or CSV.</p>

    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form action="{{ route('admin.reports.export') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Month</label>
                <select name="month" required class="mt-1 block w-full p-2 border rounded">
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ (int)date('n') === $m ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Year</label>
                <select name="year" required class="mt-1 block w-full p-2 border rounded">
                    @php $current = date('Y'); @endphp
                    @for($y = $current; $y >= $current - 5; $y--)
                        <option value="{{ $y }}" {{ $y == $current ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Report Type / Scope</label>
                <div class="mt-1">
                    <select name="report_scope" class="p-2 border rounded w-full">
                        <option value="impounded">Impounded Pets </option>
                        <option value="claimed">Claimed Pets</option>
                        <option value="adopted">Adopted Pets</option>
                        <option value="all">All (claimed + adopted + impounded)</option>
                    </select>
                </div>
            </div>

            <div class="md:col-span-3">
                <label class="block text-sm font-medium text-gray-700">Export Format</label>
                <div class="mt-1 flex items-center space-x-2">
                    <select name="format" class="p-2 border rounded">
                        <option value="pdf">PDF</option>
                        <option value="csv">CSV</option>
                    </select>
                    <button type="submit" class="px-6 py-2 ml-2 text-white bg-gray-600 rounded hover:bg-gray-700">Generate & Export</button>
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 ml-4 text-white bg-blue-600 rounded hover:bg-blue-700">Back to Dashboard</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
