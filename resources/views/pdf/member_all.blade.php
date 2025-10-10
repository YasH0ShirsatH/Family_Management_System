<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Family Members</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7f9;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    .family-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .family-table th,
    .family-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .family-table thead th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
    }

    .family-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .family-table tbody tr:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }

    .table-heading {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
        padding: 10px;
        text-align: center;
    }

    .profile-photo {
        display: block;
        margin: 0 auto;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #4CAF50;
    }

    .section-header {
        background-color: #e8f5e9;
        color: #2e7d32;
        font-weight: bold;
    }

    .data-label {
        width: 30%;
        font-weight: 500;
        color: #555;
    }

    .no-data {
        font-style: italic;
        color: #999;
    }

    .hobbies-cell {
        font-style: italic;
        color: #666;
    }
    </style>
</head>

<body>
    @php
    $pdf_actual_path =
    '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/';
    // In a real application, you'd use a more robust image path solution
    @endphp

    @foreach ($members as $member)
    <table class="family-table">
        <thead>
            <tr>
                <th colspan="2" class="table-heading">
                    Member ID #{{ $member->id }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <img src="{{ $pdf_actual_path . ($member->photo_path ?: 'noimage.png') }}" alt="Family Head Photo" class="profile-photo" width="100" height="100">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold; font-size: 1.2em;">
                    {{ $member->name }}
                </td>
            </tr>

            <tr>
                <td colspan="2" class="section-header">Personal Information</td>
            </tr>
            <tr>
                <td class="data-label">Family Head</td>
                <td>{{ $member->head->name }} {{$member->head->surname}}</td>
            </tr>
            <tr>
                <td class="data-label">Date of Birth</td>
                <td>{{ date('M d, Y', strtotime($member->birthdate)) }}</td>
            </tr>
            @if($member->marital_status)
            <tr>
                <td class="data-label">Marriage Date</td>
                <td>{{ date('M d, Y', strtotime($member->mariage_date)) }}</td>
            </tr>
            @endif
            @if($member->relation)
            <tr>
                <td class="data-label">Relation with Head</td>
                <td>{{ ucfirst($member->relation)}}</td>
            </tr>
            @endif
             @if($member->education )
            <tr>
                <td class="data-label">Education</td>
                <td>{{ $member->education }}</td>
            </tr>
            @endif

        </tbody>
    </table>
    @endforeach
</body>

</html>
