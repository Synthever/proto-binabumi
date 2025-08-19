<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <title>{{ $name ?? 'View Connections' }}</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .title {
            text-align: center;
            color: #1f2937;
            margin-bottom: 2rem;
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.875rem;
        }
        tr:hover {
            background-color: #f8fafc;
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-connected {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-disconnected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .machine-id {
            font-family: 'Monaco', 'Consolas', monospace;
            background: #f3f4f6;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.8rem;
        }
        .user-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .user-id {
            font-weight: 600;
            color: #3b82f6;
        }
        .username {
            font-size: 0.8rem;
            color: #6b7280;
        }
        .nav-links {
            text-align: center;
            margin-bottom: 2rem;
        }
        .nav-link {
            display: inline-block;
            margin: 0 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .nav-link.add-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }
        .nav-link.add-btn:hover {
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }
        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #1f2937;
        }
        .stat-label {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">🔗 Connection Records</h1>
        
        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="{{ route('test.add-connection') }}" class="nav-link add-btn">➕ Add New Connection</a>
            <a href="{{ route('test.add-users') }}" class="nav-link">👥 Add Users</a>
            <a href="{{ route('test.add-statistic') }}" class="nav-link">📊 Add Statistics</a>
        </div>

        @if($connections->count() > 0)
            <!-- Summary Statistics -->
            <div class="stats-summary">
                <div class="stat-card">
                    <div class="stat-number">{{ $connections->count() }}</div>
                    <div class="stat-label">Total Connections</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $connections->where('is_connect', true)->count() }}</div>
                    <div class="stat-label">Connected</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $connections->where('is_connect', false)->count() }}</div>
                    <div class="stat-label">Disconnected</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $connections->where('machine_id', '!=', '-')->count() }}</div>
                    <div class="stat-label">With Machines</div>
                </div>
            </div>

            <!-- Connections Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Information</th>
                            <th>Connection Status</th>
                            <th>Machine ID</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($connections as $connection)
                            <tr>
                                <td>
                                    <strong>#{{ $connection->id }}</strong>
                                </td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-id">{{ $connection->user_id }}</div>
                                        @if($connection->user)
                                            <div class="username">{{ $connection->user->username }} ({{ $connection->user->name }})</div>
                                        @else
                                            <div class="username text-red-500">User not found</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($connection->is_connect)
                                        <span class="status-badge status-connected">✅ Connected</span>
                                    @else
                                        <span class="status-badge status-disconnected">❌ Disconnected</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="machine-id">{{ $connection->machine_id }}</span>
                                </td>
                                <td>{{ $connection->date_created }}</td>
                                <td>{{ $connection->date_updated }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">🔗</div>
                <h3 style="margin-bottom: 1rem; color: #374151;">No Connections Found</h3>
                <p style="margin-bottom: 2rem;">Start by creating your first connection record.</p>
                <a href="{{ route('test.add-connection') }}" class="nav-link add-btn">
                    ➕ Create First Connection
                </a>
            </div>
        @endif
    </div>

    <script>
        // Animation on load
        document.addEventListener('DOMContentLoaded', function() {
            anime({
                targets: '.stat-card',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                delay: anime.stagger(100),
                easing: 'easeOutQuart'
            });

            anime({
                targets: 'tbody tr',
                translateX: [-30, 0],
                opacity: [0, 1],
                duration: 600,
                delay: anime.stagger(50, {start: 300}),
                easing: 'easeOutQuart'
            });
        });
    </script>
</body>

</html>
