<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Support Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #007bff; color: white; padding: 20px; text-align: center; }
        .content { background: #f8f9fa; padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Support Request</h2>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">Usertype:</span> {{ $data['usertype'] }}
            </div>
            <div class="field">
                <span class="label">Name:</span> {{ $data['name'] }}
            </div>
            <div class="field">
                <span class="label">Email:</span> {{ $data['email'] }}
            </div>
            <div class="field">
                <span class="label">Subject:</span> {{ $data['subject'] }}
            </div>
            <div class="field">
                <span class="label">Message:</span>
                <pre>{{ $data['message'] }}</pre>
            </div>
        </div>
    </div>
</body>
</html>
