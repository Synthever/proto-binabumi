<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <title>{{ $name ?? 'Add Connection' }}</title>
    <style>
        .form-container {
            max-width: 700px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #3b82f6, #10b981, #8b5cf6);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }
        .form-input, .form-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
            background: #ffffff;
        }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }
        .form-select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            appearance: none;
        }
        .btn-submit {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 180px;
            position: relative;
            overflow: hidden;
        }
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-submit:hover::before {
            left: 100%;
        }
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }
        .btn-submit:active {
            transform: translateY(-1px);
        }
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left-color: #10b981;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left-color: #ef4444;
        }
        .required {
            color: #ef4444;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 1rem;
        }
        .title {
            text-align: center;
            color: #1f2937;
            margin-bottom: 0.5rem;
            font-size: 2.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
            font-weight: 400;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        @media (min-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr 1fr;
            }
            .form-group.full-width {
                grid-column: 1 / -1;
            }
        }
        .input-hint {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.375rem;
            font-style: italic;
        }
        .icon {
            width: 20px;
            height: 20px;
            display: inline-block;
            margin-right: 8px;
            vertical-align: middle;
        }
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }
        .status-connected {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-disconnected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .form-section {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        .nav-links {
            text-align: center;
            margin-top: 2rem;
        }
        .nav-link {
            display: inline-block;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1 class="title">� Add Connection</h1>
        <p class="subtitle">Create a new user-machine connection record</p>
        
        @if(session('success'))
            <div class="alert alert-success">
                <strong>✅ Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>❌ Error!</strong>
                <ul style="margin: 0.5rem 0 0 0; padding-left: 1.2rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('connection.store') }}" method="POST">
            @csrf
            
            <!-- User Selection Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <span class="icon">👤</span>
                    User Information
                </h3>
                
                <div class="form-group">
                    <label class="form-label">
                        Select User <span class="required">*</span>
                    </label>
                    @if($users->count() > 0)
                        <select name="user_id" class="form-select" required>
                            <option value="">Choose a user...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                    ID: {{ $user->user_id }} | {{ $user->username }} ({{ $user->name }})
                                </option>
                            @endforeach
                        </select>
                        <div class="input-hint">Select an existing user to create a connection for</div>
                    @else
                        <div class="alert alert-error" style="margin: 0;">
                            <p style="margin: 0;"><strong>No users found!</strong> Please <a href="{{ route('test.add-users') }}" style="color: #991b1b; text-decoration: underline; font-weight: 600;">create a user first</a> before adding connections.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Connection Details Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <span class="icon">⚙️</span>
                    Connection Details
                </h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            Connection Status <span class="required">*</span>
                        </label>
                        <select name="is_connect" class="form-select" required>
                            <option value="">Select Status...</option>
                            <option value="0" {{ old('is_connect') === '0' ? 'selected' : '' }}>
                                ❌ Disconnected
                            </option>
                            <option value="1" {{ old('is_connect') === '1' ? 'selected' : '' }}>
                                ✅ Connected
                            </option>
                        </select>
                        <div class="input-hint">Current connection status of the user</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Machine ID <span class="required">*</span>
                        </label>
                        <input type="text" name="machine_id" class="form-input" value="{{ old('machine_id', '-') }}" required placeholder="e.g., MCH001 or -">
                        <div class="input-hint">Machine identifier (use "-" if no machine assigned)</div>
                    </div>
                </div>
            </div>

            <!-- Timestamp Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <span class="icon">📅</span>
                    Timestamp Information
                </h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            Date Created <span class="required">*</span>
                        </label>
                        <input type="text" name="date_created" class="form-input" value="{{ old('date_created') }}" required placeholder="dd-mm-yyyy hh:mm">
                        <div class="input-hint">When this connection was first created</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Date Updated <span class="required">*</span>
                        </label>
                        <input type="text" name="date_updated" class="form-input" value="{{ old('date_updated') }}" required placeholder="dd-mm-yyyy hh:mm">
                        <div class="input-hint">Last modification timestamp</div>
                    </div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="form-group" style="text-align: center; margin-top: 2.5rem;">
                @if($users->count() > 0)
                    <button type="submit" class="btn-submit">
                        � Create Connection
                    </button>
                @else
                    <button type="button" class="btn-submit" style="opacity: 0.5; cursor: not-allowed;" disabled>
                        � Create Connection
                    </button>
                    <div style="margin-top: 0.75rem; color: #6b7280; font-size: 0.875rem;">
                        Create a user first to enable this button
                    </div>
                @endif
            </div>
        </form>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="{{ route('test.add-users') }}" class="nav-link">👥 Add Users</a>
            <a href="{{ route('test.add-statistic') }}" class="nav-link">📊 Add Statistics</a>
            <a href="{{ route('test.view-connections') }}" class="nav-link">👁️ View Connections</a>
        </div>
    </div>

    <script>
        // Auto-fill current date for date fields
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const dateString = now.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            }).replace(/\//g, '-') + ' ' + now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
            
            const dateCreated = document.querySelector('input[name="date_created"]');
            const dateUpdated = document.querySelector('input[name="date_updated"]');
            
            if (dateCreated && !dateCreated.value) {
                dateCreated.value = dateString;
            }
            if (dateUpdated && !dateUpdated.value) {
                dateUpdated.value = dateString;
            }

            // Animation on load
            anime({
                targets: '.form-section',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                delay: anime.stagger(150),
                easing: 'easeOutQuart'
            });
        });

        // User selection feedback
        document.querySelector('select[name="user_id"]').addEventListener('change', function() {
            if (this.value) {
                const selectedText = this.options[this.selectedIndex].text;
                console.log('Selected user:', selectedText);
                
                // Update hint text with selected user info
                const hint = this.parentNode.querySelector('.input-hint');
                if (hint) {
                    hint.textContent = `Selected: ${selectedText}`;
                    hint.style.color = '#059669';
                    hint.style.fontWeight = '500';
                }
            } else {
                const hint = this.parentNode.querySelector('.input-hint');
                if (hint) {
                    hint.textContent = 'Select an existing user to create a connection for';
                    hint.style.color = '#6b7280';
                    hint.style.fontWeight = 'normal';
                }
            }
        });

        // Connection status feedback
        document.querySelector('select[name="is_connect"]').addEventListener('change', function() {
            const hint = this.parentNode.querySelector('.input-hint');
            if (hint) {
                if (this.value === '1') {
                    hint.innerHTML = 'Status: <span class="status-badge status-connected">Connected</span>';
                } else if (this.value === '0') {
                    hint.innerHTML = 'Status: <span class="status-badge status-disconnected">Disconnected</span>';
                } else {
                    hint.textContent = 'Current connection status of the user';
                }
            }
        });

        // Machine ID validation
        document.querySelector('input[name="machine_id"]').addEventListener('input', function() {
            const hint = this.parentNode.querySelector('.input-hint');
            if (this.value === '-') {
                hint.textContent = 'No machine assigned';
                hint.style.color = '#f59e0b';
            } else if (this.value.length > 0 && this.value !== '-') {
                hint.textContent = `Machine assigned: ${this.value}`;
                hint.style.color = '#059669';
            } else {
                hint.textContent = 'Machine identifier (use "-" if no machine assigned)';
                hint.style.color = '#6b7280';
            }
        });
    </script>
</body>

</html>