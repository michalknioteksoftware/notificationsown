<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications List</title>
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
        
        .notification-from-to {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            flex-wrap: wrap;
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
            
            .notification-from-to {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📬 Notifications</h1>
            <p>List of all notifications stored in the database</p>
        </div>
        
        <div class="notifications-list">
            @if($notifications->count() > 0)
                @foreach($notifications as $notification)
                    <div class="notification-item">
                        <div class="notification-header">
                            <span class="notification-id">#{{ $notification->id }}</span>
                            <span class="notification-date">
                                {{ $notification->created_at->format('Y-m-d H:i:s') }}
                            </span>
                        </div>
                        
                        <div class="notification-from-to">
                            <div class="notification-field">
                                <strong>From:</strong>
                                <span>{{ $notification->from }}</span>
                            </div>
                            
                            <div class="notification-field">
                                <strong>To:</strong>
                                <span>{{ $notification->to }}</span>
                            </div>
                        </div>
                        
                        <div class="notification-message">
                            <strong>Message:</strong>
                            <p>{{ $notification->message }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <h2>No notifications yet</h2>
                    <p>Notifications will appear here once they are created via the API.</p>
                </div>
            @endif
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('notifications.index') }}" class="refresh-btn">🔄 Refresh</a>
            </div>
        </div>
    </div>
</body>
</html>
