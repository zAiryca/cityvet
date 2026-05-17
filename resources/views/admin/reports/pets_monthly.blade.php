<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pets Monthly Report - {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</title>
    <style>
        @page { margin: 1cm; }
        @media print and (max-width: 8.5in) {
            @page { margin: 0.75in; } /* Letter size margins */
        }
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 0;   /* Remove default body margin */
            padding: 0;  /* Remove default body padding */
        }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f4f4f4; font-weight: bold; }
        h1 {
            font-size: 18px;
            margin: 0 0 10px 0;  /* Remove left/right margins, keep bottom */
            padding: 0;            /* Remove all padding */
        }
        h2 {
            font-size: 14px;
            margin: 15px 0 5px 0;  /* Remove left/right margins, keep top/bottom */
            padding: 0;            /* Remove all padding */
        }
        .summary { margin-bottom: 15px; background: #f9f9f9; padding: 10px; border-radius: 5px; }
        .status-adopted { background-color: #d4edda; }
        .status-claimed { background-color: #cce5ff; }
        .status-unclaimed { background-color: #fff3cd; }
        .status-unadopted { background-color: #f8d7da; }
        .status-impounded { background-color: #fff3cd; }
        .status-adoptable { background-color: #d1ecf1; }
    </style>
</head>
<body>
    <h1>City Vet - Pets Monthly Report</h1>
    <p><strong>Report Period:</strong> {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</p>

    {{-- Monthly Summary --}}
    @if($report_scope === 'impounded')
        <p><strong>Monthly Activity Summary:</strong> Total Records {{ $summaryCounts['total_records'] }}, Impounded {{ $summaryCounts['impounded'] }}</p>
    @elseif($report_scope === 'adoptable')
        <p><strong>Monthly Activity Summary:</strong> Total Records {{ $summaryCounts['total_records'] }}, Impounded {{ $summaryCounts['impounded'] }}, Adoptable {{ $summaryCounts['adoptable'] }}</p>
    @elseif($report_scope === 'claimed')
        <p><strong>Monthly Activity Summary:</strong> Total Records {{ $summaryCounts['total_records'] }}, Impounded {{ $summaryCounts['impounded'] }}, Adoptable {{ $summaryCounts['adoptable'] }}, Claimed {{ $summaryCounts['claimed'] }}</p>
    @elseif($report_scope === 'adopted')
        <p><strong>Monthly Activity Summary:</strong> Total Records {{ $summaryCounts['total_records'] }}, Impounded {{ $summaryCounts['impounded'] }}, Adoptable {{ $summaryCounts['adoptable'] }}, Adopted {{ $summaryCounts['adopted'] }}</p>
    @else
        <p><strong>Monthly Activity Summary:</strong> Total Records {{ $summaryCounts['total_records'] }}, Impounded {{ $summaryCounts['impounded'] }}, Adoptable {{ $summaryCounts['adoptable'] }}, Claimed {{ $summaryCounts['claimed'] }}, Adopted {{ $summaryCounts['adopted'] }}</p>
    @endif



    {{-- Detailed Pets Table --}}
    @if($petsData && $petsData->count() > 0)
        <h2>Detailed Pet Records ({{ ucfirst($report_scope) }})</h2>
        <table>
            <thead>
                <tr>
                    <th style="width: 40px;">No.</th>
                    <th style="width: 80px;">Code</th>
                    <th style="width: 80px;">Species</th>
                    <th style="width: 100px;">Breed</th>
                    <th style="width: 60px;">Gender</th>
                    <th>Markings</th>
                    @if(in_array($report_scope, ['impounded', 'adoptable', 'claimed', 'all']))
                        <th style="width: 90px;">Impounded</th>
                    @endif
                    @if(in_array($report_scope, ['adoptable', 'claimed', 'adopted', 'all']))
                        <th style="width: 90px;">Adoptable</th>
                    @endif
                    @if(in_array($report_scope, ['claimed', 'all']))
                        <th style="width: 90px;">Claimed</th>
                    @endif
                    @if(in_array($report_scope, ['adopted', 'all']))
                        <th style="width: 90px;">Adopted</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($petsData as $i => $pet)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $pet['code'] }}</td>
                        <td>{{ ucfirst($pet['species']) }}</td>
                        <td>{{ $pet['breed'] }}</td>
                        <td>{{ ucfirst($pet['gender']) }}</td>
                        <td>{{ $pet['markings'] }}</td>
                        @if(in_array($report_scope, ['impounded', 'adoptable', 'claimed', 'all']))
                            <td>{{ $pet['impounded_date'] ? $pet['impounded_date']->format('M d, Y') : '-' }}</td>
                        @endif
                        @if(in_array($report_scope, ['adoptable', 'claimed', 'adopted', 'all']))
                            <td>{{ $pet['adoptable_date'] ? $pet['adoptable_date']->format('M d, Y') : '-' }}</td>
                        @endif
                        @if(in_array($report_scope, ['claimed', 'all']))
                            <td>{{ $pet['claimed_date'] ? $pet['claimed_date']->format('M d, Y') : '-' }}</td>
                        @endif
                        @if(in_array($report_scope, ['adopted', 'all']))
                            <td>{{ $pet['adopted_date'] ? $pet['adopted_date']->format('M d, Y') : '-' }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No pets found for {{ ucfirst($report_scope) }} during {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}.</p>
    @endif


</body>
</html>
