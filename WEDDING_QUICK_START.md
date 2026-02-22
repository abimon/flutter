# 🎉 Wedding Page - Quick Start Guide

## ⚡ Getting Started in 5 Minutes

### Step 1: Update Your Wedding Details
Edit the file `config/wedding.php` and update:
```php
'date' => '2026-06-15',           // Your wedding date
'time' => '4:00 PM',               // Your wedding time
'venue_name' => 'Your Venue',       // Your venue name
'venue_address' => 'Full address',  // Complete address
```

Also update the honeymoon fund:
```php
'honeymoon' => [
    'goal' => 500000,              // Your fundraising goal
    'current' => 325000,           // Current amount raised
    'currency' => 'KSH',           // Currency code
    'destination' => 'Maldives',   // Honeymoon destination
],
```

### Step 2: Link Public Storage (One-time setup)
```bash
php artisan storage:link
```

This command creates a symbolic link so uploaded photos are publicly accessible.

### Step 3: Go Live!
Your wedding page is now live at:
```
http://your-domain/wedding
```

The QR code will automatically direct guests to:
```
http://your-domain/wedding/upload
```

---

## 🎨 Customization Options

### Change Wedding Theme Colors
Edit `resources/views/wedding/index.blade.php` and find the `<style>` section:
```css
--primary: #667eea;    /* Change this to your primary color */
--secondary: #764ba2;  /* Change this to your secondary color */
```

Popular wedding color combinations:
- **Romantic Pink**: `#ff69b4` & `#ffb6c1`
- **Gold & Black**: `#ffd700` & `#000000`
- **Blush & Ivory**: `#ffc0cb` & `#fffff0`
- **Emerald & Gold**: `#50c878` & `#ffd700`
- **Navy & Coral**: `#003d82` & `#ff7f50`

### Customize Currency
Update in `config/wedding.php`:
```php
'currency' => 'USD',  // Or GBP, EUR, etc.
```

### Adjust Photo Auto-Refresh
In `resources/views/wedding/index.blade.php`, find:
```javascript
setInterval(() => {
    location.reload();
}, 30000);  // Change 30000 to your desired milliseconds
```

Examples:
- `10000` = 10 seconds
- `60000` = 1 minute
- `300000` = 5 minutes

---

## 📱 What Your Guests See

### Main Page (`/wedding`)
✅ Wedding date and time  
✅ Venue with "Get Directions" button  
✅ Honeymoon fund progress  
✅ Shareable QR code  
✅ Photo gallery (auto-refreshing)  
✅ Quick action buttons  

### Mobile Upload Page (via QR code)
✅ Camera button to take photos  
✅ File picker to select from device  
✅ Drag & drop support  
✅ Preview before upload  
✅ Real-time upload progress  

---

## 🔧 Technical Details

### Routes
```
GET  /wedding              # Main wedding page
GET  /wedding/upload       # Photo upload form
POST /wedding/upload       # Process photo upload
GET  /wedding/progress     # JSON API for progress
```

### Photo Storage Location
```
storage/app/public/wedding-photos/
```

### File Limits
- **Max Size**: 10MB per image
- **Formats**: JPEG, PNG, GIF, JPG
- **Auto-organized**: By date (newest first)

---

## 🚀 Advanced Setup

### Add Custom Domain
If you want the wedding page at a custom domain:
```
https://your-wedding.com
```

Instead of:
```
https://yourdomain.com/wedding
```

This requires separate domain hosting configuration (consult your hosting provider).

### Add Wedding Details to Database
For dynamic updates, create a migration:
```bash
php artisan make:model Wedding -m
```

Then update the controller to fetch from the database instead of config.

### Enable SSL/HTTPS
Important for payment processing and mobile security:
```bash
# Check if already enabled in your hosting
php artisan config:cache
```

---

## ✅ Verification Checklist

- [ ] Updated `config/wedding.php` with your details
- [ ] Ran `php artisan storage:link`
- [ ] Visited `/wedding` page and verified it looks correct
- [ ] Tested QR code scanning from another device
- [ ] Uploaded a test photo from mobile
- [ ] Verified photo appears in gallery
- [ ] Customized colors to match your theme
- [ ] Shared the wedding page link with guests

---

## 🆘 Troubleshooting

### Photos not showing after upload
**Solution**: Run storage link command
```bash
php artisan storage:link
```

### "File not found" error
**Solution**: Check storage permissions
```bash
chmod -R 755 storage/app/public/
```

### QR code not working
**Solution**: Verify your domain is public
- Test the link from a phone's web browser
- Use a QR code scanner app to verify it works

### Page not loading at all
**Solution**: Clear cache
```bash
php artisan config:cache
php artisan route:cache
php artisan cache:clear
```

### Uploads not working on mobile
**Solution**: Check file size and format
- Keep images under 5MB for mobile networks
- Ensure JPEG/PNG format

---

## 📧 Support & Questions

### Edit Page Structure
- Main page: `resources/views/wedding/index.blade.php`
- Upload page: `resources/views/wedding/upload-form.blade.php`
- Controller: `app/Http/Controllers/WeddingController.php`
- Config: `config/wedding.php`

### Add More Features
Popular additions:
- Guest book/comments
- RSVP system
- Registry links
- Accommodation guide
- Reception timeline
- Music playlist
- Live updates

---

## 🎁 Tips for Success

1. **Share the link** via:
   - Email invitations
   - Wedding website
   - Social media
   - Text messages

2. **Promote the gallery**:
   - Ask guests to upload during celebration
   - Mention it in speeches
   - Display QR code on screens

3. **Monitor uploads**:
   - Check periodically for new photos
   - Share favorites on social media
   - Thank guests who contributed

4. **After the wedding**:
   - Download all photos from `storage/app/public/wedding-photos/`
   - Create backups
   - Share album with guests
   - Keep page live as a memory

---

Enjoy your wedding day! 💍✨
