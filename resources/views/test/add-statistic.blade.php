<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <title>{{ $name ?? 'Add Statistic' }}</title>
    <style>
        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }
        .form-input, .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        .form-select {
            background-color: white;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
        .btn-submit {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            min-width: 150px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        .required {
            color: #ef4444;
        }
        body {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 1rem;
        }
        .title {
            text-align: center;
            color: #1f2937;
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: 700;
        }
        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 2rem;
            font-size: 1rem;
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
            margin-top: 0.25rem;
        }
        .stats-icon {
            width: 24px;
            height: 24px;
            display: inline-block;
            margin-right: 8px;
            vertical-align: middle;
        }
        .number-input {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1 class="title">📊 Add User Statistics</h1>
        <p class="subtitle">Create user statistic record for tracking performance</p>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('statistic.store') }}" method="POST">
            @csrf
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="stats-icon">👤</span>User ID <span class="required">*</span>
                    </label>
                    @if($users->count() > 0)
                        <select name="user_id" class="form-select" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                    {{ $user->user_id }} - {{ $user->username }} ({{ $user->name }})
                                </option>
                            @endforeach
                        </select>
                        <div class="input-hint">Select an existing user to create statistics for</div>
                    @else
                        <div class="alert alert-error" style="margin: 0;">
                            <p style="margin: 0;">No users found. Please <a href="{{ route('test.add-users') }}" style="color: #991b1b; text-decoration: underline;">create a user first</a> before adding statistics.</p>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="stats-icon">💰</span>Balance <span class="required">*</span>
                    </label>
                    <input type="text" name="balance" class="form-input number-input" value="{{ old('balance') }}" required placeholder="e.g., 19.100">
                    <div class="input-hint">Current user balance</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="stats-icon">⭐</span>Points <span class="required">*</span>
                    </label>
                    <input type="number" name="poin" class="form-input number-input" value="{{ old('poin') }}" required placeholder="e.g., 999" min="0">
                    <div class="input-hint">User accumulated points</div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">
                        <span class="stats-icon">🍶</span>Bottle Count <span class="required">*</span>
                    </label>
                    <input type="number" name="bottle_count" class="form-input number-input" value="{{ old('bottle_count') }}" required placeholder="e.g., 100" min="0">
                    <div class="input-hint">Total bottles collected/recycled</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="stats-icon">📅</span>Date Created <span class="required">*</span>
                    </label>
                    <input type="text" name="date_created" class="form-input" value="{{ old('date_created') }}" required placeholder="dd-mm-yyyy hh:mm (e.g., 12-12-2025 19:00)">
                    <div class="input-hint">Record creation date</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="stats-icon">🔄</span>Date Updated <span class="required">*</span>
                    </label>
                    <input type="text" name="date_updated" class="form-input" value="{{ old('date_updated') }}" required placeholder="dd-mm-yyyy hh:mm (e.g., 12-12-2025 20:12)">
                    <div class="input-hint">Last update date</div>
                </div>
            </div>

            <div class="form-group full-width" style="text-align: center; margin-top: 2rem;">
                @if($users->count() > 0)
                    <button type="submit" class="btn-submit">💾 Save Statistics</button>
                @else
                    <button type="button" class="btn-submit" style="opacity: 0.5; cursor: not-allowed;" disabled>💾 Save Statistics</button>
                    <div style="margin-top: 0.5rem; color: #6b7280; font-size: 0.875rem;">
                        Create a user first to enable this button
                    </div>
                @endif
            </div>
        </form>
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
        });

        // Format number inputs
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                // Remove any non-numeric characters except decimal point
                this.value = this.value.replace(/[^0-9]/g, '');
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
                    hint.textContent = 'Select an existing user to create statistics for';
                    hint.style.color = '#6b7280';
                    hint.style.fontWeight = 'normal';
                }
            }
        });
    </script>
</body>

</html>