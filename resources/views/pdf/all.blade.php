<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Members</title>
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
        $pdf_actual_path = '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/';
       
    
    @endphp

    @foreach ($heads as $head)
        <table class="family-table">
            <thead>
                <tr>
                    <th colspan="2" class="table-heading">
                        Head ID #{{ $head->id }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <img src="{{ $pdf_actual_path.$head->photo_path }}" alt="Family Head Photo" class="profile-photo" width="100" height="100">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold; font-size: 1.2em;">
                        {{ $head->name }} {{ $head->surname }}
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="section-header">Personal Information</td>
                </tr>
                <tr>
                    <td class="data-label">Date of Birth</td>
                    <td>{{ date('M d, Y', strtotime($head->birthdate)) }}</td>
                </tr>
                <tr>
                    <td class="data-label">Mobile</td>
                    <td>{{ $head->mobile }}</td>
                </tr>
                @if($head->marital_status)
                    <tr>
                        <td class="data-label">Marriage Date</td>
                        <td>{{ date('M d, Y', strtotime($head->mariage_date)) }}</td>
                    </tr>
                @endif

                <tr>
                    <td colspan="2" class="section-header">Address Information</td>
                </tr>
                <tr>
                    <td class="data-label">Address</td>
                    <td>{{ $head->address }}</td>
                </tr>
                <tr>
                    <td class="data-label">City</td>
                    <td>{{ ucfirst($head->city) }}</td>
                </tr>
                <tr>
                    <td class="data-label">State</td>
                    <td>{{ ucfirst($head->state) }}</td>
                </tr>
                <tr>
                    <td class="data-label">Pincode</td>
                    <td>{{ $head->pincode }}</td>
                </tr>
                <tr>
                    <td class="data-label">Family Members</td>
                    <td>{{ $head->members->count() }},
                        (
                            @foreach ($head->members as $member)
                                {{ ucfirst($member->name) }}@if(!$loop->last), @endif 
                            @endforeach
                        )
                    </td>
                </tr>

                <tr>
                    <td class="data-label">Hobbies & Interests</td>
                    <td class="hobbies-cell">
                        @if($head->hobbies && count($head->hobbies) > 0)
                            @foreach ($head->hobbies as $hobby)
                                {{ ucfirst($hobby->hobby_name) }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            <span class="no-data">No hobbies listed</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>
</html>