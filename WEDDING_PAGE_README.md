# 💍 Wedding Page Setup Guide

## Overview
A beautiful single-page wedding website created with Laravel that includes:
- ✅ Wedding date and venue information
- ✅ Support contribution progress tracker
- ✅ Bride and groom photo gallery
- ✅ QR code for photo uploads
- ✅ Mobile-friendly upload form with camera support

## Features

### 1. **Main Wedding Page** (`/wedding`)
Displays all wedding information in an elegant, responsive design with:
- Wedding date and time
- Venue location and address
- Honeymoon fund progress bar
- Shareable QR code
- Photo gallery gallery that auto-refreshes every 30 seconds
- Quick action buttons (Upload Photos, Get Directions)

### 2. **Photo Upload Page** (`/wedding/upload`)
Accessible via QR code, allows guests to:
- Take photos directly from phone camera
- Select photos from device
- Drag and drop file upload
- Preview before uploading
- Real-time upload progress

### 3. **API Endpoint** (`/wedding/progress` - GET)
Returns JSON with progress data:
```json
{
  "goal": 500000,
  "current": 325000,
  "percentage": 65.00
}
```

## Routes

```
GET  /wedding              - Main wedding page
GET  /wedding/upload       - Photo upload form
POST /wedding/upload       - Handle photo upload
GET  /wedding/progress     - Get contribution progress (JSON)
```

## Customization

### Edit Wedding Details

Open the file [WeddingController.php](../../app/Http/Controllers/WeddingController.php#L16) and modify the following values in the `index()` method:

```php
'weddingDate' => '2026-06-15',              // Change the date
'weddingTime' => '4:00 PM',                 // Change the time
'venue' => 'Grand Ballroom, Nairobi',       // Change the venue name
'venue_address' => '123 Wedding Lane...',   // Change the address
'contributionGoal' => 500000,               // Set the goal amount
'contributionCurrent' => 325000,            // Update current amount
```

### Customize Styling

Edit the CSS in the view files:
- [Wedding Index Page Styles](../../resources/views/wedding/index.blade.php#L36)
- [Upload Form Styles](../../resources/views/wedding/upload-form.blade.php#L10)

Colors used:
- Primary: `#667eea` (Indigo)
- Secondary: `#764ba2` (Purple)
- Background gradient: `linear-gradient(135deg, #667eea 0%, #764ba2 100%)`

Change these hex colors throughout the CSS to match your wedding theme.

### Photo Storage

Uploaded photos are stored in:
```
storage/app/public/wedding-photos/
```

Make sure to run the following command to link public storage if not already done:
```bash
php artisan storage:link
```

## QR Code

The QR code is generated dynamically using the free QR Server API:
```
https://api.qrserver.com/v1/create-qr-code/
```

It points to: `{your-domain}/wedding/upload`

The QR code will always direct guests to the upload form when scanned.

## Upload Specifications

- **Supported formats**: JPEG, PNG, GIF, JPG
- **Maximum file size**: 10MB
- **Automatic features**:
  - Mobile camera access
  - Drag & drop support
  - Image preview before upload
  - Progress indicator
  - Auto-redirect to main page after successful upload

## File Structure

```
resources/views/wedding/
├── index.blade.php          # Main wedding page
└── upload-form.blade.php    # Photo upload form

app/Http/Controllers/
└── WeddingController.php    # Controller with all logic

routes/
└── web.php                  # Wedding routes

storage/app/public/
└── wedding-photos/          # Uploaded photo storage
```

## Requirements

- Laravel 9.x or higher
- PHP 8.0.2 or higher
- Public storage linked (`php artisan storage:link`)

## Installation & Setup

1. **Routes are already configured** in [routes/web.php](../../routes/web.php)

2. **Link public storage** (if not already done):
   ```bash
   php artisan storage:link
   ```

3. **Clear application cache**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   ```

4. **Access the wedding page**:
   ```
   http://your-domain/wedding
   ```

## Mobile Access

The page is fully responsive and optimized for:
- Smartphones (iOS & Android)
- Tablets
- Desktop browsers

The QR code directs to a mobile-optimized upload page.

## Auto-Refresh Gallery

The main wedding page auto-refreshes every 30 seconds to display newly uploaded photos. This can be customized in [index.blade.php](../../resources/views/wedding/index.blade.php#L202):

```javascript
// Change the interval (in milliseconds)
setInterval(() => {
    location.reload();
}, 30000); // 30 seconds
```

## Troubleshooting

### Photos not showing up
- Ensure storage is linked: `php artisan storage:link`
- Check file permissions in `storage/app/public/wedding-photos/`
- Clear browser cache

### QR code not working
- Ensure the application is accessible from a public URL
- Test QR code with a smartphone camera app
- Verify routes are properly cached

### Upload fails
- Check file size (max 10MB)
- Verify file format (JPEG, PNG, GIF)
- Ensure `storage/app/public` directory exists and is writable

## Security Notes

- Only image files are accepted (validated on server)
- File size is limited to 10MB
- CSRF protection is enabled on upload endpoint
- All uploads are stored safely in the public directory

## Future Enhancements

Consider adding:
- Guest management/RSVP system
- Guest message board
- Wedding registry link
- Accommodation information
- Gift registry
- Wedding timeline/schedule
- Instagram feed integration
