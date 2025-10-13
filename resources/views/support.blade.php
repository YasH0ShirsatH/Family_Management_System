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
        body {
            background: white;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .contact-form {
            background: #fff;
            margin: 3rem auto;
            max-width: 900px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            border: none;
            overflow: hidden;
            position: relative;
        }

        .contact-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #007bff, #0056b3, #28a745, #ffc107);
        }

        .contact-image {
            text-align: center;
            padding: 40px 0 30px;

            position: relative;
        }

        .contact-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #007bff, transparent);
        }

        .contact-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 10px 30px rgba(0,123,255,0.2);
            transition: all 0.4s ease;
            object-fit: cover;
        }

        .contact-image img:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 40px rgba(0,123,255,0.3);
        }

        .contact-form h3 {
            text-align: center;
            color: #2c3e50;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 40px;
            position: relative;
            background: linear-gradient(45deg, #007bff, #0056b3);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .contact-form form {
            padding: 0 50px 50px;
            background: #fff;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .form-label::before {
            content: '';
            width: 4px;
            height: 4px;
            background: #007bff;
            border-radius: 50%;
            margin-right: 8px;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 15px 20px;
            transition: all 0.3s ease;
            font-size: 15px;
            background-color: #f8f9fa;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(0,123,255,0.15), inset 0 2px 4px rgba(0,0,0,0.05);
            background-color: #fff;
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #007bff;
            background-color: #fff;
        }

        .form-control[readonly] {
            background-color: #e9ecef;
            opacity: 0.8;
            cursor: not-allowed;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 140px;
            font-family: inherit;
        }

        .btnContact {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 18px 30px;
            background: linear-gradient(45deg, #007bff, #0056b3);
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,123,255,0.3);
        }

        .btnContact::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .btnContact:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0,123,255,0.4);
            background: linear-gradient(45deg, #0056b3, #004085);
        }

        .btnContact:hover::before {
            left: 100%;
        }

        .btnContact:active {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0,123,255,0.3);
        }

        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .alert-success {
            background: linear-gradient(45deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(45deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        @media (max-width: 768px) {
            .contact-form {
                margin: 1rem;
                border-radius: 15px;
            }

            .contact-form form {
                padding: 0 25px 40px;
            }

            .contact-form h3 {
                font-size: 2rem;
            }

            .form-control {
                padding: 12px 15px;
            }

            .btnContact {
                padding: 15px 25px;
                font-size: 15px;
            }
        }

        @media (max-width: 576px) {
            .contact-form h3 {
                font-size: 1.7rem;
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
