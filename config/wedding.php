<?php

/**
 * Wedding Page Configuration
 * 
 * Edit this file to customize your wedding page details
 */

return [
    
    // Wedding Date (YYYY-MM-DD format)
    'date' => '2026-04-05',
    
    // Wedding Time (12-hour format recommended)
    'time' => '10:00 AM',
    
    // Venue Name
    'venue_name' => 'Amakara, Nyamira',
    
    // Venue Complete Address
    'venue_address' => 'SDA Church Valley, Amakara',

    // Venue Coordinates (optional, for Google Maps) 0.742497, 35.024424
    'venue_latitude' => '-0.742497',
    'venue_longitude' => '35.024424',
    
    // Bride Name
    'bride_name' => 'Lydia Moraa Ongera',
    
    // Groom Name
    'groom_name' => 'Caleb Nyabera Kefa',
    
    // Honeymoon Fund
    'honeymoon' => [
        'enabled' => true,
        'goal' => 400000,        // In KES or your currency
        'current' => 125000,     // Current amount raised
        'currency' => 'KSH',
        'destination' => 'Maldives',
        'description' => 'Help us create unforgettable memories on our honeymoon!',
    ],
    
    // Bride & Groom Details
    'bride' => [
        'name' => 'Lydia Moraa Ongera',
        'photo' => '/storage/config/bride.jpeg',
    ],
    
    'groom' => [
        'name' => 'Caleb Nyabera Kefa',
        'photo' => '/storage/config/groom.jpeg',
    ],
    
    // Wedding Theme Colors
    'colors' => [
        'primary' => '#EB1241',      // Indigo
        'secondary' => '#0824C4',    // Purple
        'accent' => '#ff69b4',       // Optional accent color
    ],
    
    // Photo Gallery Settings
    'gallery' => [
        'auto_refresh' => true,
        // 'refresh_interval' => 30000, // milliseconds (30 seconds)
        'max_photos_display' => 12,
    ],
    
    // Upload Settings
    'upload' => [
        'max_file_size' => 10240,    // KB (10MB)
        'allowed_formats' => ['jpeg', 'png', 'jpg', 'gif'],
        'storage_path' => 'wedding-photos',
    ],
    
    // QR Code Settings
    'qr_code' => [
        'size' => 300,         // pixels
        'error_correction' => 'M', // L, M, Q, H
    ],
    
];
