<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
    @vite('resources/css/app.css')
    <title>View Statistics - SIGMA</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .title {
            text-align: center;
            color: #1f2937;
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: 700;
        }
        body {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 1rem;
        }
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .stats-table th,
        .stats-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .stats-table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
        }
        .stats-table tr:hover {
            background-color: #f9fafb;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        }
        .no-data {
            text-align: center;
            color: #6b7280;
            padding: 2rem;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">📊 User Statistics</h1>
        
        <div style="margin-bottom: 1rem;">
            <a href="{{ route('test.add-statistic') }}" class="btn">+ Add New Statistic</a>
        </div>

        @if($statistics->count() > 0)
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Balance</th>
                        <th>Points</th>
                        <th>Bottle Count</th>
                        <th>Date Created</th>
                        <th>Date Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statistics as $stat)
                    <tr>
                        <td>{{ $stat->id }}</td>
                        <td>{{ $stat->user_id }}</td>
                        <td>{{ $stat->balance }}</td>
                        <td>{{ number_format($stat->poin) }}</td>
                        <td>{{ number_format($stat->bottle_count) }}</td>
                        <td>{{ $stat->date_created }}</td>
                        <td>{{ $stat->date_updated }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                <p>No statistics data found.</p>
                <a href="{{ route('test.add-statistic') }}" class="btn">Add First Statistic</a>
            </div>
        @endif
    </div>
</body>

</html>
