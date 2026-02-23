<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0824c4 0%, #eb1241 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Section */
        .header {
            text-align: center;
            color: white;
            padding: 40px 20px;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 3.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 300;
            letter-spacing: 2px;
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.95;
        }

        /* Main Grid */
        .wedding-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .card h2 {
            color: #0824c4;
            margin-bottom: 20px;
            font-size: 1.8em;
            border-bottom: 3px solid #eb1241;
            padding-bottom: 15px;
        }

        /* Date & Venue */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-box {
            background: linear-gradient(135deg, #0824c415 0%, #eb124115 100%);
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #0824c4;
        }

        .info-box h3 {
            color: #0824c4;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-box p {
            font-size: 1.3em;
            color: #333;
            font-weight: 500;
        }

        .venue-address {
            font-size: 0.95em !important;
            color: #666 !important;
            font-weight: 400 !important;
            margin-top: 5px;
        }

        /* Bride & Groom Profiles */
        .couple-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 0.6s ease-out;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            align-items: baseline;
            margin: 0 auto 20px;
            border: 4px solid #0824c4;
            display: block;
        }

        .profile-name {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .profile-title {
            font-size: 1em;
            color: #eb1241;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Progress Bar */
        .progress-section h3 {
            color: #0824c4;
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.95em;
        }

        .progress-bar {
            width: 100%;
            height: 25px;
            background: #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0824c4 0%, #eb1241 100%);
            width: 65%;
            transition: width 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 10px;
            color: white;
            font-size: 0.8em;
            font-weight: bold;
        }

        .currency {
            font-size: 0.9em;
            color: #666;
        }

        /* QR Code Section */
        .qr-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: linear-gradient(135deg, #0824c415 0%, #eb124115 100%);
            border-radius: 15px;
        }

        .qr-section h3 {
            color: #0824c4;
            margin-bottom: 20px;
            font-size: 1.2em;
            text-align: center;
        }

        .qr-code-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .qr-code-container svg {
            max-width: 100%;
            height: auto;
        }

        .qr-instruction {
            font-size: 0.95em;
            color: #666;
            text-align: center;
            margin-top: 15px;
        }

        /* Photos Section */
        .photos-section {
            grid-column: 1 / -1;
        }

        .photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .photo-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            aspect-ratio: 1;
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-item:hover img {
            transform: scale(1.1);
        }

        .no-photos {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2em;
            }

            .couple-grid {
                grid-template-columns: 1fr;
                margin-bottom: 30px;
            }

            .profile-image {
                width: 120px;
                height: 120px;
            }

            .profile-name {
                font-size: 1.4em;
            }

            .wedding-grid {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .qr-code-container {
                max-width: 300px;
            }

            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.6s ease-out;
        }

        .card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .card:nth-child(3) {
            animation-delay: 0.4s;
        }

        .card:nth-child(4) {
            animation-delay: 0.6s;
        }

        .profile-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .profile-card:nth-child(2) {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body>
    <div class="" style="height: 100vh; width: 100vw; display: flex; align-items: center; justify-content: center;">
        <div class="container profile-card w-75 m-auto">
            <h1>✨ Wedding Call Center</h1>

            <form method="POST" action="{{ route('wedding.call-center') }}" class="mb-4 profile-card">
                @csrf
                <div class="mb-3">
                    <label for="phone" class="form-label">Enter your username</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g. Lydia Caleb" value="{{ old('phone', $phone ?? '') }}">
                    @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary">Lookup</button>
            </form>

            @if(isset($assignments))
            @if($assignments && $assignments->count())
            <div class="info">
                <h4>Contacts to call for {{ $phone }}</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignments as $assign)
                        <form method="POST" action="/wedding/updateCallResponse/{{ $assign->id }}">
                            @csrf
                            <div class="text-start row">
                                <div class="col-md-5 mb-2">
                                    <div class="mb-2">@if($assign->contact_name ==null)
                                        <input type="text" name="contact_name" placeholder="Enter contact name..." class="form-control">
                                        @else
                                        {{ $assign->contact_name }}
                                        @endif
                                    </div>
                                    <a href="tel:{{ $assign->contact_phone }}">{{ $assign->contact_phone }}</a>
                                </div>
                                <div class="col-md-7 mb-2">
                                    <div class="mb-2">
                                        <textarea name="response" class="form-control" placeholder="Enter call response...">{{ $assign->response }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-warning">No call assignments found for that number.</div>
            @endif
            @endif

            <a href="{{ route('wedding.index') }}">← Back to Wedding Page</a>
        </div>
    </div>

</body>

</html>