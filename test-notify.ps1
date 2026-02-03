# PowerShell script to test the notify endpoint
# Make sure to set your API_TOKEN in .env file first
# Run with: powershell -ExecutionPolicy Bypass -File .\test-notify.ps1

# Read API_TOKEN from .env file (if exists)
$envContent = Get-Content .env -ErrorAction SilentlyContinue
$apiToken = ($envContent | Select-String -Pattern "^API_TOKEN=(.+)$").Matches.Groups[1].Value
if (-not $apiToken) {
    $apiToken = "your-secret-token-here"
    Write-Host "Warning: API_TOKEN not found in .env, using default. Make sure to set it in .env file!" -ForegroundColor Yellow
}

$headers = @{
    "Content-Type" = "application/json"
    "Authorization" = "Bearer $apiToken"
}

$body = @{
    from = "sender@example.com"
    to = "recipient@example.com"
    message = "This is a test notification message"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost/api/notify" -Method Post -Headers $headers -Body $body
