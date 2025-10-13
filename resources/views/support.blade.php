<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Support - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Contact Form Styles */
        .contact-form {
            background: #fff;
            margin: 2rem auto;
            max-width: 800px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,123,255,0.1);
            overflow: hidden;
        }

        .contact-form .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-size: 14px;
            background-color: #f8f9fa;
        }

        .contact-form .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
            background-color: #fff;
            transform: translateY(-1px);
        }

        .contact-form .form-control:hover {
            border-color: #007bff;
            background-color: #fff;
        }

        .contact-image {
            text-align: center;
            margin-bottom: 25px;
            padding: 20px 0;
            background: linear-gradient(135deg, rgba(0,123,255,0.1), rgba(0,123,255,0.05));
        }

        .contact-image img {
            border-radius: 50%;
            width: 90px;
            height: 90px;
            object-fit: cover;
            border: 4px solid #007bff;
            box-shadow: 0 5px 15px rgba(0,123,255,0.3);
            transition: all 0.3s ease;
        }

        .contact-image img:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0,123,255,0.4);
        }

        .contact-form form {
            padding: 40px;
            background: #fff;
        }

        .contact-form form .row {
            margin-bottom: 20px;
        }

        .contact-form h3 {
            margin-bottom: 30px;
            text-align: center;
            color: #007bff;
            font-weight: 700;
            font-size: 2.2rem;
            position: relative;
        }

        .contact-form h3::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, #007bff, #0056b3);
            border-radius: 2px;
        }

        .contact-form .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .contact-form .btnContact {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            background: linear-gradient(45deg, #007bff, #0056b3);
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .contact-form .btnContact::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .contact-form .btnContact:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,123,255,0.4);
            background: linear-gradient(45deg, #0056b3, #004085);
        }

        .contact-form .btnContact:hover::before {
            left: 100%;
        }

        .contact-form .btnContact:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        }

        .contact-form textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        @media (max-width: 768px) {
            .contact-form {
                margin: 1rem;
                border-radius: 10px;
            }

            .contact-form form {
                padding: 25px;
            }

            .contact-form h3 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-2"></i>Please fix the following errors:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="container contact-form">
            <form method="post" action="{{ route('support.send') }}">
                @csrf
                <div class="contact-image">
                    <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
                </div>
                <h3>Drop Changes Required in Database</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" value="{{ $admin1->first_name }} {{ $admin1->last_name }}" readonly required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Your Email</label>
                            <input type="email" name="email"   class="form-control" placeholder="Your Email *" value="{{ $admin1->email }}" readonly required/>
                        </div>
                        <div class="form-group ">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject *" value="{{ old('subject') }}"  required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" required>{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
