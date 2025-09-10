<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Details</title>
</head>

<body style="font-family: 'Segoe UI', Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0;">
    <div style="max-width: 900px; margin: 30px auto; padding: 0 15px;">
        <div
            style="box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-radius: 16px; margin-bottom: 24px; background-color: #fff;">
            <div
                style="background-color: #0d6efd; color: #fff; text-align: center; padding: 32px 0 24px 0; border-radius: 16px 16px 0 0;">
                <h2 style="margin: 0; font-size: 1.5em;">
                    <span style="font-size: 1.5em; vertical-align: middle;"></span> {{ $heads->name }} Family
                    Details
                </h2>
            </div>
            <div style="padding: 32px; text-align: center;">
                <img src="{{ $pdf_actual_path }}" alt="Family Head Photo"
                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 24px;">
                <h3 style="font-weight: bold; margin-bottom: 24px; color: #212529;">{{ $heads->name }}
                    {{ $heads->surname }}</h3>
                <div style="display: flex; flex-wrap: wrap; margin: -12px;">
                    <div style="width: 100%; padding: 12px; box-sizing: border-box; display: inline-block;">
                        <div
                            style="background-color: #f8f9fa; border-radius: 16px; height: 100%; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <div style="padding: 24px;">
                                <h5 style="color: #0d6efd; margin-bottom: 16px; font-size: 1.2em;">
                                    <span style="font-size: 1.2em; vertical-align: middle;"></span> Personal
                                    Information
                                </h5>
                                <div style="margin: 0; padding: 0; list-style: none;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; background-color: transparent; padding: 8px 0; font-size: 1em;">
                                        <span style="color: #6c757d;">
                                            <span style="font-size: 1em; vertical-align: middle;"> </span> Date
                                            of Birth
                                        </span>
                                        <span
                                            style="font-weight: 600;">{{ date('M d, Y', strtotime($heads->birthdate)) }}</span>
                                    </div>
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; background-color: transparent; padding: 8px 0; font-size: 1em;">
                                        <span style="color: #6c757d;">
                                            <span style="font-size: 1em; vertical-align: middle;"></span>
                                            Mobile
                                        </span>
                                        <span style="font-weight: 600;">{{ $heads->mobile }}</span>
                                    </div>
                                    @if($heads->marital_status)
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; background-color: transparent; padding: 8px 0; font-size: 1em;">
                                        <span style="color: #6c757d;">
                                            <span
                                                style="font-size: 1em; vertical-align: middle;"></span>
                                            Marriage Date
                                        </span>
                                        <span
                                            style="font-weight: 600;">{{ date('M d, Y', strtotime($heads->mariage_date)) }}</span>
                                    </div>
                                    @endif
                                    <div>
                                        <div
                                            style="background-color: #f8f9fa; border-radius: 16px; height: 100%; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                            <div style="padding: 24px;">
                                                <h5 style="color: #0d6efd; margin-bottom: 16px; font-size: 1.2em;">
                                                    <span style="font-size: 1.2em; vertical-align: middle;"></span> Address
                                                    Information
                                                </h5>
                                                <div style="margin: 0; padding: 0; list-style: none;">
                                                    <div
                                                        style="display: flex; justify-content: space-between; align-items: center; background-color: transparent; padding: 8px 0; font-size: 1em;">
                                                        <span style="color: #6c757d;">
                                                            <span style="font-size: 1em; vertical-align: middle;"></span>
                                                            Address
                                                        </span>
                                                        <span style="font-weight: 600; text-align: right;">{{ $heads->address }}</span>
                                                    </div>
                                                    <div
                                                        style="display: flex; justify-content: space-between; align-items: center; background-color: transparent; padding: 8px 0; font-size: 1em;">
                                                        <span style="color: #6c757d;">
                                                            <span style="font-size: 1em; vertical-align: middle;"></span> City
                                                        </span>
                                                        <span style="font-weight: 600;">{{ ucfirst($heads->city) }}</span>
                                                    </div>
                                                    <div
                                                        style="display: flex; justify-content: space-between; align-items: center; background-color: transparent; padding: 8px 0; font-size: 1em;">
                                                        <span style="color: #6c757d;">
                                                            <span style="font-size: 1em; vertical-align: middle;"></span> State
                                                        </span>
                                                        <span style="font-weight: 600;">{{ ucfirst($heads->state) }}</span>
                                                    </div>
                                                    <div
                                                        style="display: flex; justify-content: space-between; align-items: center; background-color: transparent; padding: 8px 0; font-size: 1em;">
                                                        <span style="color: #6c757d;">
                                                            <span style="font-size: 1em; vertical-align: middle;"></span>
                                                            Pincode
                                                        </span>
                                                        <span style="font-weight: 600;">{{ $heads->pincode }}</span>
                                                    </div>
                                                    <div
                                                        style="background-color: #f8f9fa; border-radius: 16px; margin-top: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                                        <div style="padding: 24px;">
                                                            <h5 style="color: #0d6efd; margin-bottom: 16px; font-size: 1.2em;">
                                                                <span style="font-size: 1.2em; vertical-align: middle;"></span> Hobbies & Interests
                                                            </h5>
                                                            <p style="margin: 0; font-weight: 600;">
                                                                @foreach ($heads->hobbies as $hobby)
                                                                <span
                                                                    style="display: inline-block; padding: 6px 14px; font-size: 0.95em; border-radius: 12px; background-color: #6c757d; color: #fff; margin-right: 8px; margin-bottom: 8px;">{{ ucfirst($hobby->hobby_name) }}</span>
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                        
                    
                </div>
                
            </div>
        </div>

        @if($heads->members->count() > 0)
        <div
            style="box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-radius: 16px; margin-bottom: 24px; background-color: #fff;">
            <div
                style="background-color: #198754; color: #fff; text-align: center; padding: 16px 0; border-radius: 16px 16px 0 0;">
                <h1 style="margin: 0; font-size: 1.5em;">
                    <span style="font-size: 1.5em; vertical-align: middle;"></span> Family Members
                </h1>
            </div>
            <div style="padding: 24px;">
                <div style="display: flex; flex-wrap: wrap; margin: -12px;">
                    @foreach($heads->members as $member)
                    <div style="width: 100%; padding: 12px; box-sizing: border-box; display: inline-block;">
                        <div
                            style="border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); height: 100%; background-color: #fff;">
                            @if(empty($member->photo_path))
                            <img src="{{ '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/noimage.png' }}"
                                alt="No Image"
                                style="height: 200px; object-fit: cover; width: 100%; border-radius: 16px 16px 0 0;">
                            @else
                            <img src="{{ '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/' . $member->photo_path }}"
                                alt="Member Photo"
                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 24px;">
                                 
                            @endif
                            <div style="padding: 16px;">
                                <h2 style="font-weight: bold; color: #0d6efd; margin-bottom: 16px; font-size: 1.2em;">
                                    {{ $member->name }}</h2>
                                <div style="font-size: 0.95em;">
                                    <p style="margin-bottom: 8px; display: flex; align-items: center;">
                                        
                                        <span>Birth Date: {{ date('M d, Y', strtotime($member->birthdate)) }}</span>
                                    </p>
                                    <p style="margin-bottom: 8px; display: flex; align-items: center;">
                                        <span
                                            style="font-size: 1em; vertical-align: middle; margin-right: 8px;"></span>
                                        <span>Marital Status:
                                            {{ $member->marital_status ? 'Married' : 'Single' }}</span>
                                        @if($member->marital_status == 1)
                                        <span style="margin-left: 4px;"> (Date: {{ $member->mariage_date }})</span>
                                        @endif
                                    </p>
                                    <p style="margin-bottom: 0; display: flex; align-items: center;">
                                        <span
                                            style="font-size: 1em; vertical-align: middle; margin-right: 8px;"></span>
                                        Education:
                                        @if($member->education)
                                        <span style="margin-left: 4px;">{{ $member->education }}</span>
                                        @else
                                        <span style="color: #6c757d; font-style: italic; margin-left: 4px;">Not
                                            provided</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</body>

</html>