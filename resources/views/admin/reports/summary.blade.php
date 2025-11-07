<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityVet Report Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #2563eb;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .stat-card h3 {
            margin: 0 0 10px 0;
            color: #2563eb;
            font-size: 14px;
        }
        .stat-card .number {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #2563eb;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CityVet Management System</h1>
        <p>Report Summary</p>
        <p>Generated on: {{ now()->format('F j, Y \a\t g:i A') }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Pets</h3>
            <div class="number">{{ $total_pets }}</div>
        </div>
        <div class="stat-card">
            <h3>Impounded Pets</h3>
            <div class="number">{{ $impounded }}</div>
        </div>
        <div class="stat-card">
            <h3>Adoptable Pets</h3>
            <div class="number">{{ $adoptable }}</div>
        </div>
        <div class="stat-card">
            <h3>Adopted Pets</h3>
            <div class="number">{{ $adopted }}</div>
        </div>
        <div class="stat-card">
            <h3>Lost & Found Posters</h3>
            <div class="number">{{ $lost_found }}</div>
        </div>
        <div class="stat-card">
            <h3>Total Events</h3>
            <div class="number">{{ $events }}</div>
        </div>
        <div class="stat-card">
            <h3>Successful Adoptions</h3>
            <div class="number">{{ $adoptions }}</div>
        </div>
        <div class="stat-card">
            <h3>Successful Claims</h3>
            <div class="number">{{ $claims }}</div>
        </div>
    </div>

    <div class="section">
        <h2>Recent Pets</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Species</th>
                    <th>Status</th>
                    <th>Added Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_pets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->species }}</td>
                    <td>{{ ucfirst($pet->status) }}</td>
                    <td>{{ $pet->created_at->format('M j, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No recent pets found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Recent Events</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Event Date</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->event_date->format('M j, Y g:i A') }}</td>
                    <td>{{ $event->created_at->format('M j, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No recent events found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>This report was generated automatically by the CityVet Management System.</p>
        <p>For more detailed information, please access the admin dashboard.</p>
    </div>
</body>
</html>
