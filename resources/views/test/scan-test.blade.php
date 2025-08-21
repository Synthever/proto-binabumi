<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Scan Integration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .test-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .test-button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 5px;
            font-size: 16px;
        }
        .test-button:hover {
            background: #0056b3;
        }
        .success { color: #28a745; }
        .error { color: #dc3545; }
        .info { color: #17a2b8; }
        .result {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        pre {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>🔧 Test Scan Integration</h1>
        <p>Halaman ini untuk testing koneksi JavaScript dengan ScanController</p>
        
        <div class="test-buttons">
            <button class="test-button" onclick="testValidCode()">Test Valid Code</button>
            <button class="test-button" onclick="testInvalidCode()">Test Invalid Code</button>
            <button class="test-button" onclick="testConnectionStatus()">Test Connection Status</button>
            <button class="test-button" onclick="clearResults()">Clear Results</button>
        </div>

        <div id="results"></div>
    </div>

    <script>
        function addResult(title, content, type = 'info') {
            const resultsDiv = document.getElementById('results');
            const resultDiv = document.createElement('div');
            resultDiv.className = 'result';
            resultDiv.innerHTML = `
                <h3 class="${type}">${title}</h3>
                <pre>${JSON.stringify(content, null, 2)}</pre>
                <small>Time: ${new Date().toLocaleTimeString()}</small>
            `;
            resultsDiv.appendChild(resultDiv);
            resultsDiv.scrollTop = resultsDiv.scrollHeight;
        }

        async function testValidCode() {
            addResult('🔄 Testing Valid Code...', 'Sending request to /scan/process with MACHINE_001');
            
            try {
                const response = await fetch('/scan/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        machine_code: 'MACHINE_001'
                    })
                });

                const data = await response.json();
                
                if (response.ok && data.success) {
                    addResult('✅ Valid Code Test SUCCESS', data, 'success');
                } else {
                    addResult('❌ Valid Code Test FAILED', data, 'error');
                }

            } catch (error) {
                addResult('❌ Valid Code Test ERROR', error.message, 'error');
            }
        }

        async function testInvalidCode() {
            addResult('🔄 Testing Invalid Code...', 'Sending request to /scan/process with INVALID_CODE');
            
            try {
                const response = await fetch('/scan/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        machine_code: 'INVALID_CODE'
                    })
                });

                const data = await response.json();
                
                if (!response.ok && !data.success) {
                    addResult('✅ Invalid Code Test SUCCESS', data, 'success');
                } else {
                    addResult('❌ Invalid Code Test FAILED', data, 'error');
                }

            } catch (error) {
                addResult('❌ Invalid Code Test ERROR', error.message, 'error');
            }
        }

        async function testConnectionStatus() {
            addResult('🔄 Testing Connection Status...', 'Sending request to /scan/status');
            
            try {
                const response = await fetch('/scan/status', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();
                
                if (response.ok) {
                    addResult('✅ Connection Status Test SUCCESS', data, 'success');
                } else {
                    addResult('❌ Connection Status Test FAILED', data, 'error');
                }

            } catch (error) {
                addResult('❌ Connection Status Test ERROR', error.message, 'error');
            }
        }

        function clearResults() {
            document.getElementById('results').innerHTML = '';
        }

        // Show page load info
        document.addEventListener('DOMContentLoaded', function() {
            addResult('🎯 Page Loaded', 'Ready to test scan integration!');
        });
    </script>
</body>
</html>
