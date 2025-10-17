<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Registration Confirmation</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1d1d1f;
            background: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 650px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #0d6efd, #6f42c1);
            color: white;
            padding: 40px 32px;
            text-align: center;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px 0;
        }
        .header p {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
        }
        .content {
            padding: 32px;
        }
        .section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #0d6efd;
            margin: 0 0 20px 0;
            display: flex;
            align-items: center;
        }
        .icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            background: #0d6efd;
            border-radius: 50%;
        }
        .field-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .field {
            margin-bottom: 16px;
        }
        .field-label {
            font-size: 12px;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .field-value {
            font-size: 15px;
            color: #212529;
            font-weight: 500;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #d1ecf1;
            color: #0c5460;
        }
        .member-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
        }
        .member-header {
            font-size: 16px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e9ecef;
        }
        .footer {
            background: #f8f9fa;
            padding: 24px 32px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer-text {
            font-size: 14px;
            color: #6c757d;
            margin: 0;
        }
        @media (max-width: 600px) {
            .field-grid {
                grid-template-columns: 1fr;
            }
            .content {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Family Registration Successful</h1>
            <p>{{ $data['head_name'] }} {{ $data['head_surname'] }}'s Family</p>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">
                    <div class="icon"></div>
                    Family Head Information
                </div>

                <div class="field-grid">
                    <div class="field">
                        <div class="field-label">Full Name</div>
                        <div class="field-value">{{ $data['head_name'] }} {{ $data['head_surname'] }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Date of Birth</div>
                        <div class="field-value">{{ $data['head_birthdate'] }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Mobile Number</div>
                        <div class="field-value">{{ $data['head_mobile'] }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Email Address</div>
                        <div class="field-value">{{ $data['head_email'] }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">State</div>
                        <div class="field-value">{{ $data['head_state'] }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">City</div>
                        <div class="field-value">{{ $data['head_city'] }}</div>
                    </div>
                </div>

                <div class="field">
                    <div class="field-label">Address</div>
                    <div class="field-value">{{ $data['head_address'] }}</div>
                </div>

                <div class="field">
                    <div class="field-label">Marital Status</div>
                    <div class="field-value">
                        <span class="status-badge">
                            @if($data['head_marital_status']) Married @else Unmarried @endif
                        </span>
                    </div>
                </div>

                <div class="field">
                    <div class="field-label">Hobbies</div>
                    <div class="field-value">
                         @foreach ($data['head_hobbies'] as $hobby)
                        <span class="status-badge">
                                {{ $hobby }}
                        </span>
                      @endforeach
                    </div>
                </div>

                @if($data['head_marital_status'] == 1)
                <div class="field">
                    <div class="field-label">Marriage Date</div>
                    <div class="field-value">{{ $data['head_mariage_date'] }}</div>
                </div>
                @endif
            </div>



            @if(isset($data['members']))
            <div class="section">
                <div class="section-title">
                    <div class="icon"></div>
                    Family Members ({{ count($data['members']) }})
                </div>

                @foreach($data['members'] as $index => $member)
                <div class="member-card">
                    <div class="member-header">Member {{ $index + 1 }}: {{ $member['name'] }}</div>

                    <div class="field-grid">
                        <div class="field">
                            <div class="field-label">Date of Birth</div>
                            <div class="field-value">{{ $member['birthdate'] }}</div>
                        </div>
                        <div class="field">
                            <div class="field-label">Relation</div>
                            <div class="field-value">{{ ucfirst($member['relation']) }}</div>
                        </div>
                        <div class="field">
                            <div class="field-label">Marital Status</div>
                            <div class="field-value">
                                <span class="status-badge">
                                    @if($member['marital_status'] == 1) Married @else Unmarried @endif
                                </span>
                            </div>
                        </div>
                        @if($member['marital_status'] == 1 && !empty($member['mariage_date']))
                        <div class="field">
                            <div class="field-label">Marriage Date</div>
                            <div class="field-value">{{ $member['mariage_date'] }}</div>
                        </div>
                        @endif
                    </div>

                    @if(!empty($member['education']))
                    <div class="field">
                        <div class="field-label">Education</div>
                        <div class="field-value">{{ $member['education'] }}</div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="footer">
            <p class="footer-text">
                Registration completed on {{ now()->format('F j, Y \a\t g:i A') }}<br>
                Family Management System
            </p>
        </div>
    </div>
</body>
</html>
