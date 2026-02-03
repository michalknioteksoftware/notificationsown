<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications Sent</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .header h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #666;
            font-size: 1.1em;
        }
        
        .header-nav {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        
        .nav-link {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .nav-link:hover {
            background: #5568d3;
        }
        
        .nav-link.active {
            background: #764ba2;
        }
        
        .notifications-list {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .notification-item {
            border-left: 4px solid #667eea;
            padding: 20px;
            margin-bottom: 20px;
            background: #f8f9fa;
            border-radius: 5px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .notification-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        
        .notification-id {
            background: #667eea;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9em;
        }
        
        .notification-date {
            color: #666;
            font-size: 0.9em;
        }
        
        .notification-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 15px;
        }
        
        .notification-field {
            flex: 1;
            min-width: 200px;
        }
        
        .notification-field strong {
            color: #333;
            display: block;
            margin-bottom: 5px;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .notification-field span {
            color: #555;
            font-size: 1em;
            word-break: break-word;
        }
        
        .sent-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9em;
        }
        
        .sent-status.true {
            background: #10b981;
            color: white;
        }
        
        .sent-status.false {
            background: #ef4444;
            color: white;
        }
        
        .channel-badge {
            display: inline-block;
            background: #764ba2;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9em;
        }
        
        .notification-message {
            background: white;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
            margin-top: 10px;
        }
        
        .notification-message strong {
            color: #333;
            display: block;
            margin-bottom: 10px;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .notification-message p {
            color: #555;
            line-height: 1.6;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .empty-state h2 {
            font-size: 2em;
            margin-bottom: 10px;
            color: #999;
        }
        
        .empty-state p {
            font-size: 1.1em;
        }
        
        .refresh-btn {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: background 0.3s;
        }
        
        .refresh-btn:hover {
            background: #5568d3;
        }
        
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2em;
            }
            
            .notification-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .notification-info {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📤 Notifications Sent</h1>
            <p>List of all notifications that have been sent through channels</p>
            <div class="header-nav">
                <a href="{{ route('notifications.index') }}" class="nav-link">📬 All Notifications</a>
                <a href="{{ route('notifications.sent') }}" class="nav-link active">📤 Sent Notifications</a>
            </div>
        </div>
        
        <div class="notifications-list">
            @if($notificationsSent->count() > 0)
                @foreach($notificationsSent as $sent)
                    <div class="notification-item">
                        <div class="notification-header">
                            <span class="notification-id">#{{ $sent->id }}</span>
                            <span class="notification-date">
                                Sent at: {{ $sent->created_at->format('Y-m-d H:i:s') }}
                            </span>
                        </div>
                        
                        <div class="notification-info">
                            <div class="notification-field">
                                <strong>Notification ID:</strong>
                                <span>#{{ $sent->notification_id }}</span>
                            </div>
                            
                            <div class="notification-field">
                                <strong>Channel:</strong>
                                <span class="channel-badge">{{ $sent->channel }}</span>
                            </div>
                            
                            <div class="notification-field">
                                <strong>Sent Status:</strong>
                                <span class="sent-status {{ $sent->sent ? 'true' : 'false' }}">
                                    {{ $sent->sent ? '✓ Sent' : '✗ Not Sent' }}
                                </span>
                            </div>
                        </div>
                        
                        @if($sent->notification)
                            <div class="notification-info" style="margin-top: 15px;">
                                <div class="notification-field">
                                    <strong>From:</strong>
                                    <span>{{ $sent->notification->from }}</span>
                                </div>
                                
                                <div class="notification-field">
                                    <strong>To:</strong>
                                    <span>{{ $sent->notification->to }}</span>
                                </div>
                            </div>
                            
                            <div class="notification-message">
                                <strong>Message:</strong>
                                <p>{{ $sent->notification->message }}</p>
                            </div>
                        @else
                            <div class="notification-message" style="background: #fee; border-color: #fcc;">
                                <strong>⚠️ Warning:</strong>
                                <p>Related notification not found (may have been deleted)</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <h2>No sent notifications yet</h2>
                    <p>Notifications will appear here once they are processed by the worker.</p>
                </div>
            @endif
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('notifications.sent') }}" class="refresh-btn">🔄 Refresh</a>
            </div>
        </div>
    </div>
</body>
</html>
