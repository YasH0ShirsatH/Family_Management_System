<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Request</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.5;
            color: #1d1d1f;
            background: #f5f5f7;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        }

        .header {
            background: linear-gradient(135deg, #007aff, #5856d6);
            color: white;
            padding: 32px 24px;
            text-align: center;
        }

        .header h1 {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 4px 0;
        }

        .header p {
            font-size: 15px;
            opacity: 0.9;
            margin: 0;
        }

        .content {
            padding: 32px 24px;
        }

        .field {
            margin-bottom: 24px;
        }

        .field-label {
            font-size: 13px;
            font-weight: 600;
            color: #86868b;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 6px;
        }

        .field-value {
            font-size: 16px;
            color: #1d1d1f;
            font-weight: 400;
        }

        .priority {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 600;
        }

        .priority-low {
            background: #d1f2eb;
            color: #00875a;
        }

        .priority-medium {
            background: #fff4e6;
            color: #974f0c;
        }

        .priority-high {
            background: #ffebe6;
            color: #de350b;
        }

        .priority-critical {
            background: #ffebe6;
            color: #de350b;
        }

        .message-box {
            background: #f5f5f7;
            border-radius: 8px;
            padding: 16px;
            font-size: 15px;
            line-height: 1.6;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .footer {
            background: #f5f5f7;
            padding: 24px;
            text-align: center;
            border-top: 1px solid #d2d2d7;
        }

        .footer-text {
            font-size: 13px;
            color: #86868b;
            margin: 0;
        }

        .divider {
            height: 1px;
            background: #d2d2d7;
            margin: 24px 0;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .container {
                border-radius: 8px;
            }

            .header,
            .content,
            .footer {
                padding: 24px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Support Request</h1>
            <p>Family Management System</p>
        </div>

        <div class="content">
            <div class="field">
                <div class="field-label">From</div>
                <div class="field-value">{{ $data['name'] }} &lt;{{ $data['email'] }}&gt;</div>
            </div>

            <div class="field">
                <div class="field-label">Subject</div>
                <div class="field-value">{{ $data['subject'] }}</div>
            </div>

            <div class="field">
                <div class="field-label">Priority</div>
                <div class="field-value">
                    <span class="priority priority-{{ strtolower($data['priority']) }}">
                        {{ $data['priority'] }}
                    </span>
                </div>
            </div>

            <div class="field">
                <div class="field-label">User Type</div>
                <div class="field-value">{{ $data['usertype'] }}</div>
            </div>

            <div class="divider"></div>

            <div class="field">
                <div class="field-label">Message</div>
                <div class="field-value">
                    <div class="message-box">{{ $data['message'] }}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p class="footer-text">
                Received {{ now()->format('M j, Y \a\t g:i A') }}
            </p>
        </div>
    </div>
</body>

</html>
