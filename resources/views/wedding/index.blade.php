<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Wedding Day</title>
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
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>💍 Our Wedding Day 💍</h1>
            <p>Join us for the celebration of love</p>
        </div>
        <div class="row p-5 m-2 mb-3 profile-card">
            <div class="col-6">
                <img src="/storage/config/bride.jpeg" alt="" class="profile-image">
                <div class="profile-name">{{ $brideInfo['name'] ?? 'Bride' }}</div>
                <div class="profile-title">👰 The Bride</div>
            </div>
            <div class="col-6">
                <img src="/storage/config/groom.jpeg" alt="" class="profile-image">
                <div class="profile-name">{{ $groomInfo['name'] ?? 'Groom' }}</div>
                <div class="profile-title">🤵 The Groom</div>
            </div>
        </div>
        <!-- Bride & Groom Section -->
        

        <!-- Main Content Grid -->
        <div class="wedding-grid">
            <!-- Date & Venue Card -->
            <div class="card">
                <h2>📅 Event Details</h2>
                <div class="info-grid">
                    <div class="info-box">
                        <h3>Date</h3>
                        <p>{{ date('F j, Y', strtotime($weddingDate)) }}</p>
                    </div>
                    <div class="info-box">
                        <h3>Time</h3>
                        <p>{{ $weddingTime }}</p>
                    </div>
                </div>
                <div class="info-box" style="margin-top: 15px; grid-column: 1 / -1;">
                    <h3>📍 Venue</h3>
                    <p>{{ $venue }}</p>
                    <p class="venue-address">{{ $venue_address }}</p>
                </div>
            </div>

            <!-- Contribution Progress Card -->
            <div class="card">
                <h2>💝 Support Us</h2>
                <div class="progress-section">
                    <h3>Fund Progress</h3>
                    <div class="progress-info">
                        <span>Raised</span>
                        <span class="currency">{{ $currency ?? 'KSH' }} {{ number_format($contributionCurrent) }}</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width:<?php echo ($contributionCurrent / $contributionGoal) * 100 ?>%;">
                            {{ round(($contributionCurrent / $contributionGoal) * 100) }}%
                        </div>
                    </div>
                    <div class="progress-info">
                        <span>Goal</span>
                        <span class="currency">{{ $currency ?? 'KSH' }} {{ number_format($contributionGoal) }}</span>
                    </div>
                </div>
            </div>

            <!-- QR Code Card -->
            <div class="card">
                <h2>📸 Share Photos</h2>
                <div class="qr-section">
                    <h3>Scan to Upload Photos</h3>
                    <div class="qr-code-container">
                        <img src="{{ $qrCodeUrl }}" alt="QR Code to upload photos" style="max-width: 100%; height: auto;">
                    </div>
                    <p class="qr-instruction">
                        Point your phone camera at this QR code to share your photos from the wedding 📱
                    </p>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card">
                <h2>🎯 Quick Links</h2>
                <div class="info-grid">
                    <button onclick="location.href='<?php echo route('wedding.upload-form') ?>'"
                        style="padding: 15px; background: linear-gradient(135deg, #0824c4 0%, #eb1241 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1em; text-decoration: none;">
                        📤 Upload Photos
                    </button>
                    <a href="https://maps.google.com/?q={{ urlencode($venue_address) }}" target="_blank"
                        style="padding: 15px; background: linear-gradient(135deg, #0824c4 0%, #eb1241 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1em; text-decoration: none;">
                        🗺️ Get Directions</a>

                </div>
            </div>

            <!-- Photos Gallery -->
            <div class="card photos-section">
                <h2>📷 Wedding Moments</h2>
                <div class="photos-grid">
                    @forelse($photos as $photo)
                    <div class="photo-item">
                        <img src="{{ $photo }}" alt="Wedding photo" loading="lazy">
                    </div>
                    @empty
                    <div class="no-photos">
                        No photos uploaded yet. Scan the QR code to share your moments! 📸
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>