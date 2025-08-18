<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <title>{{ $name ?? 'Add Users' }}</title>
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
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .form-select {
            background-color: white;
            cursor: pointer;
        }
        .btn-submit {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
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
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    </style>
</head>

<body>
    <div class="form-container">
        <h1 class="title">Add New User</h1>
        
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

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">User ID <span class="required">*</span></label>
                    <input type="text" name="user_id" class="form-input" value="{{ old('user_id') }}" required placeholder="e.g., 1947281">
                    <div class="input-hint">Must be unique</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Username <span class="required">*</span></label>
                    <input type="text" name="username" class="form-input" value="{{ old('username') }}" required placeholder="e.g., djoko">
                    <div class="input-hint">Must be unique</div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="name" class="form-input" value="{{ old('name') }}" required placeholder="e.g., Djoko Waluyo">
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number <span class="required">*</span></label>
                    <input type="text" name="no_handphone" class="form-input" value="{{ old('no_handphone') }}" required placeholder="e.g., 085155558787">
                </div>

                <div class="form-group">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" required placeholder="e.g., djokowaluyo@gmail.com">
                </div>

                <div class="form-group">
                    <label class="form-label">Connection Status <span class="required">*</span></label>
                    <select name="is_connect" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="false" {{ old('is_connect') == 'false' ? 'selected' : '' }}>Not Connected</option>
                        <option value="true" {{ old('is_connect') == 'true' ? 'selected' : '' }}>Connected</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Machine ID</label>
                    <input type="text" name="machine_id" class="form-input" value="{{ old('machine_id', '-') }}" placeholder="e.g., MCH001 or leave as -">
                </div>

                <div class="form-group">
                    <label class="form-label">Date Created <span class="required">*</span></label>
                    <input type="text" name="date_created" class="form-input" value="{{ old('date_created') }}" required placeholder="dd-mm-yyyy hh:mm (e.g., 12-12-2025 19:00)">
                </div>

                <div class="form-group">
                    <label class="form-label">Date Updated <span class="required">*</span></label>
                    <input type="text" name="date_updated" class="form-input" value="{{ old('date_updated') }}" required placeholder="dd-mm-yyyy hh:mm (e.g., 12-12-2025 20:12)">
                </div>
            </div>

            <div class="form-group full-width" style="text-align: center; margin-top: 2rem;">
                <button type="submit" class="btn-submit">Add User</button>
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
    </script>
</body>

</html>