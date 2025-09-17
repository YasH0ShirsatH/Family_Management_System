<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Family Details</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #ffffff;">
    <div style="width: 100%; max-width: 800px; margin: 0 auto;">
        <div style="background-color: #ffffff; border: 1px solid #ddd; margin-bottom: 20px;">
            <div style="background-color: #0d6efd; color: #ffffff; text-align: center; padding: 30px;">
                <h2 style="margin: 0; font-size: 24px; font-weight: bold;">{{ $heads->name }} Family Details</h2>
            </div>
            <div style="padding: 30px; text-align: center;">
                <img src="{{ $pdf_actual_path }}" alt="Family Head Photo" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #ffffff; margin-bottom: 20px;">
                <h3 style="font-weight: bold; margin-bottom: 20px; color: #333333; font-size: 20px;">{{ $heads->name }} {{ $heads->surname }}</h3>
                
                <div style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px;">
                    <h5 style="color: #0d6efd; margin-bottom: 15px; font-size: 16px; font-weight: bold;">Personal Information</h5>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Date of Birth</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ date('M d, Y', strtotime($heads->birthdate)) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Mobile</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ $heads->mobile }}</td>
                        </tr>
                        @if($heads->marital_status)
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Marriage Date</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ date('M d, Y', strtotime($heads->mariage_date)) }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                <div style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px;">
                    <h5 style="color: #0d6efd; margin-bottom: 15px; font-size: 16px; font-weight: bold;">Address Information</h5>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Address</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ $heads->address }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">City</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ ucfirst($heads->city) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">State</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ ucfirst($heads->state) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Pincode</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ $heads->pincode }}</td>
                        </tr>
                    </table>
                </div>

                <div style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px;">
                    <h5 style="color: #0d6efd; margin-bottom: 15px; font-size: 16px; font-weight: bold;">Hobbies & Interests</h5>
                    <p style="margin: 0; font-weight: 600; text-align: left;">
                        @if($heads->hobbies && count($heads->hobbies) > 0)
                            @foreach ($heads->hobbies as $hobby)
                                {{ ucfirst($hobby->hobby_name) }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            No hobbies listed
                        @endif
                    </p>
                </div>

                @if($heads->members && $heads->members->count() > 0)
                <div style="background-color: #f8f9fa; padding: 20px;">
                    <h5 style="color: #0d6efd; margin-bottom: 15px; font-size: 16px; font-weight: bold;">Family Members</h5>
                    @foreach($heads->members as $member)
                    <div style="border: 1px solid #ddd; margin-bottom: 15px; padding: 15px; background-color: #ffffff;">
                        <div style="text-align: center; margin-bottom: 15px;">
                            @if($member->photo)
                            <img src="{{ public_path('storage/' . $member->photo) }}" alt="{{ $member->name }}" style="width: 80px; height: 80px; border-radius: 50%; border: 2px solid #ddd; margin-bottom: 10px;">
                            @endif
                            <h6 style="margin: 0; font-size: 14px; font-weight: bold; color: #333333;">{{ $member->name }} {{ $member->surname }}</h6>
                        </div>
                        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left;">Relation</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">{{ ucfirst($member->relation) }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left;">Date of Birth</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">{{ date('M d, Y', strtotime($member->birthdate)) }}</td>
                            </tr>
                            @if($member->mobile)
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left;">Mobile</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">{{ $member->mobile }}</td>
                            </tr>
                            @endif
                            @if($member->marital_status)
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left;">Marriage Date</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">{{ date('M d, Y', strtotime($member->mariage_date)) }}</td>
                            </tr>
                            @endif
                            @if($member->hobbies && count($member->hobbies) > 0)
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left; vertical-align: top;">Hobbies</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">
                                    @foreach($member->hobbies as $hobby)
                                        {{ ucfirst($hobby->hobby_name) }}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</body> -->

</html>







<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Family Details</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #ffffff;">
    <div style="width: 100%; max-width: 800px; margin: 0 auto;">
        <div style="background-color: #ffffff; border: 1px solid #ddd; margin-bottom: 20px;">
            <div style="background-color: #0d6efd; color: #ffffff; text-align: center; padding: 30px;">
                <h2 style="margin: 0; font-size: 24px; font-weight: bold;">{{ $heads->name }} Family Details</h2>
            </div>
            <div style="padding: 30px; text-align: center;">
                <img src="{{ $pdf_actual_path }}" alt="Family Head Photo" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #ffffff; margin-bottom: 20px;">
                <h3 style="font-weight: bold; margin-bottom: 20px; color: #333333; font-size: 20px;">{{ $heads->name }} {{ $heads->surname }}</h3>
                
                <div style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px;">
                    <h5 style="color: #0d6efd; margin-bottom: 15px; font-size: 16px; font-weight: bold;">Personal Information</h5>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Date of Birth</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ date('M d, Y', strtotime($heads->birthdate)) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Mobile</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ $heads->mobile }}</td>
                        </tr>
                        @if($heads->marital_status)
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Marriage Date</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ date('M d, Y', strtotime($heads->mariage_date)) }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                <div style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px;">
                    <h5 style="color: #0d6efd; margin-bottom: 15px; font-size: 16px; font-weight: bold;">Address Information</h5>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Address</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ $heads->address }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">City</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ ucfirst($heads->city) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">State</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ ucfirst($heads->state) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #666666; text-align: left;">Pincode</td>
                            <td style="padding: 8px 0; font-weight: 600; text-align: right;">{{ $heads->pincode }}</td>
                        </tr>
                    </table>
                </div>

                <div style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px;">
                    <h5 style="color: #0d6efd; margin-bottom: 15px; font-size: 16px; font-weight: bold;">Hobbies & Interests</h5>
                    <p style="margin: 0; font-weight: 600; text-align: left;">
                        @if($heads->hobbies && count($heads->hobbies) > 0)
                            @foreach ($heads->hobbies as $hobby)
                                {{ ucfirst($hobby->hobby_name) }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            No hobbies listed
                        @endif
                    </p>
                </div>

                @if($heads->members && $heads->members->count() > 0)
                <div style="background-color: #f8f9fa; padding: 20px;">
                    <h5 style="color: #0d6efd; margin-bottom: 15px; font-size: 16px; font-weight: bold;">Family Members</h5>
                    @foreach($heads->members as $member)
                    <div style="border: 1px solid #ddd; margin-bottom: 15px; padding: 15px; background-color: #ffffff;">
                        <div style="text-align: center; margin-bottom: 15px;">
                            @if(empty($member->photo_path))
                            <img src="{{ '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/noimage.png' }}"
                                alt="No Image"
                                style="width: 80px; height: 80px; border-radius: 50%; border: 2px solid #ddd; margin-bottom: 10px;">
                            @else
                            <img src="{{ '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/' . $member->photo_path }}"
                                alt="Member Photo"
                               style="width: 80px; height: 80px; border-radius: 50%; border: 2px solid #ddd; margin-bottom: 10px;">
                                 
                            @endif
                            <h6 style="margin: 0; font-size: 14px; font-weight: bold; color: #333333;">{{ $member->name }} {{ $member->surname }}</h6>
                        </div>
                        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left;">Education</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;"> @if(ucfirst($member->education))
                                     {{  ucfirst($member->education) }}
                                @else
                                    Not Provided
                                @endif</td>
                            </tr>
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left;">Date of Birth</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">{{ date('M d, Y', strtotime($member->birthdate)) }}</td>
                            </tr>
                            @if($member->mobile)
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left;">Mobile</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">{{ $member->mobile }}</td>
                            </tr>
                            @endif
                            @if($member->marital_status)
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left;">Marriage Date</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">{{ date('M d, Y', strtotime($member->mariage_date)) }}</td>
                            </tr>
                            @endif
                            @if($member->hobbies && count($member->hobbies) > 0)
                            <tr>
                                <td style="padding: 4px 0; color: #666666; text-align: left; vertical-align: top;">Hobbies</td>
                                <td style="padding: 4px 0; font-weight: 600; text-align: right;">
                                    @foreach($member->hobbies as $hobby)
                                        {{ ucfirst($hobby->hobby_name) }}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>