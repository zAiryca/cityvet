<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pets Monthly Report - {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f4f4f4; }
        h1 { font-size: 16px; margin-bottom: 6px; }
        .summary { margin-bottom: 12px; }
    </style>
</head>
<body>
    <h1>Pets Report - {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</h1>

    <div class="summary">
        <strong>Summary</strong>
        <div>Impounded this month: {{ $impoundedCount ?? 0 }}</div>
        <div>Claimed this month: {{ $claimedCount ?? 0 }}</div>
        <div>Adopted this month: {{ $adoptedCount ?? 0 }}</div>
    </div>

    {{-- Render tables according to scope (or show all tables) --}}
    @php $scope = $report_scope ?? 'impounded'; @endphp

    {{-- Claimed pets table --}}
    @if(in_array($scope, ['claimed', 'all']) && !empty($claimedPets) && $claimedPets->count())
        <h2>Claimed Pets</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Code Name</th>
                    <th>Species</th>
                    <th>Breed</th>
                    <th>Color/markings</th>
                    <th>Impounded Date</th>
                    <th>Claimed Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($claimedPets as $i => $pet)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $pet->display_code }}</td>
                        <td>{{ $pet->species }}</td>
                        <td>{{ $pet->breed }}</td>
                        <td>{{ $pet->color_markings ?? '' }}</td>
                        <td>{{ $pet->impounded_date ? $pet->impounded_date->format('M d, Y') : '' }}</td>
                        <td>{{ $pet->claimed_date ? \Carbon\Carbon::parse($pet->claimed_date)->format('M d, Y') : '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif($scope === 'claimed')
        <p>No claimed pets found for selected month.</p>
    @endif

    {{-- Adopted pets table --}}
    @if(in_array($scope, ['adopted', 'all']) && !empty($adoptedPets) && $adoptedPets->count())
        <h2>Adopted Pets</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Code Name</th>
                    <th>Species</th>
                    <th>Breed</th>
                    <th>Color/markings</th>
                    <th>Impounded Date</th>
                    <th>Adoptable Date</th>
                    <th>Adopted Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adoptedPets as $i => $pet)
                    @php
                        $adoptableDate = !$pet->impounded_date ? ($pet->created_at ?? null) : null;
                    @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $pet->display_code }}</td>
                        <td>{{ $pet->species }}</td>
                        <td>{{ $pet->breed }}</td>
                        <td>{{ $pet->color_markings ?? '' }}</td>
                        <td>{{ $pet->impounded_date ? $pet->impounded_date->format('M d, Y') : '' }}</td>
                        <td>{{ $adoptableDate ? $adoptableDate->format('M d, Y') : '' }}</td>
                        <td>{{ $pet->adopted_date ? \Carbon\Carbon::parse($pet->adopted_date)->format('M d, Y') : '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif($scope === 'adopted')
        <p>No adopted pets found for selected month.</p>
    @endif

    {{-- Impounded pets table (when requested) --}}
    @if(in_array($scope, ['impounded', 'all']) )
        @if(!empty($impoundedPets) && $impoundedPets->count())
            <h2>Impounded Pets</h2>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Code Name</th>
                        <th>Species</th>
                        <th>Breed</th>
                        <th>Color/markings</th>
                        <th>Impounded Date</th>
                        <th>Claimed Date</th>
                        <th>Adopted Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($impoundedPets as $i => $pet)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $pet->display_code }}</td>
                            <td>{{ $pet->species }}</td>
                            <td>{{ $pet->breed }}</td>
                            <td>{{ $pet->color_markings ?? '' }}</td>
                            <td>{{ $pet->impounded_date ? $pet->impounded_date->format('M d, Y') : '' }}</td>
                            <td>{{ $pet->claimed_date ? $pet->claimed_date->format('M d, Y') : '' }}</td>
                            <td>{{ $pet->adopted_date ? $pet->adopted_date->format('M d, Y') : '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @if($scope === 'impounded')
                <p>No impounded pets found for selected month.</p>
            @endif
        @endif
    @endif
</body>
</html>
