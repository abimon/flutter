@extends('layouts.wedding', ['title' => 'Our Wedding Day'])
@section('content')
<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>💍 Our Wedding Day 💍</h1>
        <p>Join us for the celebration of love</p>
    </div>
    <div class="row p-5 m-2 mb-3 profile-card">
        <div class="col-6">
            <img src="/storage/config/bride.jpeg" alt="" class="profile-image">
            <div class="profile-name" style="text-transform:uppercase;">{{ $brideInfo['name'] ?? 'Bride' }}</div>
            <div class="profile-title">👰 The Bride</div>
        </div>
        <div class="col-6">
            <img src="/storage/config/groom.jpeg" alt="" class="profile-image">
            <div class="profile-name" style="text-transform:uppercase;">{{ $groomInfo['name'] ?? 'Groom' }}</div>
            <div class="profile-title">🤵 The Groom</div>
        </div>
    </div>
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
                <button onclick="location.href='<?php echo route('wedding.call-center') ?>'"
                    style="padding: 15px; background: linear-gradient(135deg, #0824c4 0%, #eb1241 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1em; text-decoration: none;">
                    ☎️ Call Center
                </button>
                <button onclick="location.href='<?php echo route('contributions.index') ?>'"
                    style="padding: 15px; background: linear-gradient(135deg, #0824c4 0%, #eb1241 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1em; text-decoration: none;">
                    💰 Contributions
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
@endsection