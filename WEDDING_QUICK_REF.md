# 💍 Wedding Page - Installation Quick Reference

Quick reference for the most common setup and customization tasks.

---

## ⚡ 3-Step Installation

```bash
# STEP 1: Edit configuration
nano config/wedding.php
# Update: date, time, venue_name, venue_address, honeymoon details

# STEP 2: Link storage
php artisan storage:link

# STEP 3: Done! Visit your page
# https://yourdomain.com/wedding
```

---

## 🎨 Customization Quick Guide

### Change Wedding Date
**File:** `config/wedding.php`  
**Find:** `'date' => '2026-06-15',`  
**Change to:** `'date' => 'YYYY-MM-DD',`

### Change Wedding Time
**File:** `config/wedding.php`  
**Find:** `'time' => '4:00 PM',`  
**Change to:** `'time' => 'HH:MM AM/PM',`

### Change Venue
**File:** `config/wedding.php`  
**Find:** `'venue_name' => 'Grand Ballroom, Nairobi',`  
**Change to:** `'venue_name' => 'Your Venue',`

### Change Address
**File:** `config/wedding.php`  
**Find:** `'venue_address' => '123 Wedding Lane, Nairobi, Kenya',`  
**Change to:** `'venue_address' => 'Your Address',`

### Change Fundraising Goal
**File:** `config/wedding.php`  
**Find:** `'goal' => 500000,`  
**Change to:** `'goal' => YOUR_AMOUNT,`

### Change Current Amount Raised
**File:** `config/wedding.php`  
**Find:** `'current' => 325000,`  
**Change to:** `'current' => AMOUNT_RAISED,`

### Change Currency
**File:** `config/wedding.php`  
**Find:** `'currency' => 'KSH',`  
**Change to:** `'currency' => 'USD',` (or EUR, GBP, etc.)

### Change Primary Color (Indigo → Your Color)
**File:** `resources/views/wedding/index.blade.php`  
**Find:** `#667eea` (appears multiple times in CSS)  
**Change to:** Your hex color (e.g., `#ff69b4` for pink)

### Change Secondary Color (Purple → Your Color)
**File:** `resources/views/wedding/index.blade.php`  
**Find:** `#764ba2` (appears multiple times in CSS)  
**Change to:** Your hex color (e.g., `#ffb6c1` for light pink)

### Change Auto-Refresh Speed
**File:** `resources/views/wedding/index.blade.php`  
**Find:** `}, 30000);` (near bottom of file)  
**Change 30000 to:**
- `10000` = 10 seconds
- `30000` = 30 seconds
- `60000` = 1 minute
- `300000` = 5 minutes

### Change Maximum Upload Size
**File:** `config/wedding.php`  
**Find:** `'max_file_size' => 10240,`  
**Change to:** Size in KB (e.g., `20480` for 20MB)

---

## 🚀 Routes Quick Reference

| URL | Purpose |
|-----|---------|
| `/wedding` | Main wedding page |
| `/wedding/upload` | Photo upload form |
| `/wedding/progress` | JSON progress data |

---

## 📁 Important Files

```
config/wedding.php
├─ date
├─ time
├─ venue_name
├─ venue_address
├─ honeymoon.goal
├─ honeymoon.current
├─ honeymoon.currency
├─ colors.primary
├─ colors.secondary
└─ gallery.refresh_interval

resources/views/wedding/index.blade.php
├─ Main styling (#667eea and #764ba2)
├─ HTML structure
└─ auto-refresh script

app/Http/Controllers/WeddingController.php
├─ index()         (main page)
├─ uploadForm()    (upload page)
├─ upload()        (handle upload)
└─ getProgress()   (API endpoint)
```

---

## 🎯 Most Common Tasks

### Task 1: View Your Wedding Page
```
Visit: https://yourdomain.com/wedding
```

### Task 2: Test Photo Upload
1. Visit `/wedding`
2. Click "Upload Photos" button
3. Select a test image
4. Upload should succeed
5. Photo should appear in gallery after 30 seconds

### Task 3: Share with Guests
```
Email/Text/Social:
"View our wedding: https://yourdomain.com/wedding
Scan the QR code to upload your photos!"
```

### Task 4: Download All Photos After Wedding
```bash
# From server, download the folder:
scp -r user@server:/path/wedding/storage/app/public/wedding-photos/ ~/my-wedding-photos/
```

### Task 5: Backup Everything
```bash
# Create compressed backup
tar -czf wedding-backup.tar.gz path/to/wedding/

# Save to different location
mv wedding-backup.tar.gz ../backups/
```

---

## 🐛 Quick Fixes

### Photos not showing after upload
```bash
php artisan storage:link
php artisan cache:clear
```

### Page won't load
```bash
php artisan config:cache
php artisan route:cache
php artisan cache:clear
```

### Upload not working
```bash
# Check file size limit
php -r "echo ini_get('upload_max_filesize');"

# Check directory permissions
ls -la storage/app/public/wedding-photos/

# Fix if needed
chmod 755 storage/app/public/wedding-photos/
sudo chown -R www-data:www-data storage/app/public/wedding-photos/
```

### QR code not scanning
- Increase size in config (change 300 to 400)
- Print QR code larger
- Ensure good lighting when scanning

---

## 💡 Pro Tips

1. **Pre-wedding test run:**
   - Upload a test photo
   - Verify it appears correctly
   - Test QR code scanning

2. **During reception:**
   - Display the main wedding page on a TV
   - Photos refresh in real-time as guests upload
   - Creates a live photo stream effect

3. **Post-wedding:**
   - Download all photos immediately
   - Create multiple backups
   - Share with guests
   - Keep page live as a memory

4. **Customization:**
   - Change colors to match your theme
   - Update honeymoon destination
   - Set realistic fundraising goal

5. **Guest engagement:**
   - Print QR codes on tables
   - Mention photo upload in program
   - Thank guests who upload photos
   - Share favorite photos to social media

---

## 📞 File Locations at a Glance

| What | Where |
|------|-------|
| Wedding details | `config/wedding.php` |
| Main page HTML | `resources/views/wedding/index.blade.php` |
| Upload page HTML | `resources/views/wedding/upload-form.blade.php` |
| Page logic | `app/Http/Controllers/WeddingController.php` |
| Page routes | `routes/web.php` |
| Uploaded photos | `storage/app/public/wedding-photos/` |
| Photo access URL | `yourdomain.com/storage/wedding-photos/` |

---

## ✅ Pre-Launch Checklist

- [ ] Updated `config/wedding.php` with your details
- [ ] Ran `php artisan storage:link`
- [ ] Tested page loads: `/wedding`
- [ ] Tested upload works
- [ ] Tested on mobile device
- [ ] Tested QR code scanning
- [ ] Customized colors (optional)
- [ ] Verified photos appear in gallery
- [ ] Tested progress bar shows correctly
- [ ] Ready to share with guests!

---

## 🎉 You're All Set!

Your wedding page is ready to use. Here's what to do now:

1. ✅ **Configure** - Update `config/wedding.php`
2. ✅ **Link Storage** - Run `php artisan storage:link`
3. ✅ **Test** - Visit `/wedding` and test upload
4. ✅ **Customize** - Change colors if desired
5. ✅ **Share** - Send link to guests!

---

**Questions?** See [WEDDING_INDEX.md](WEDDING_INDEX.md) for a complete documentation index.

**Deployment help?** See [WEDDING_DEPLOYMENT.md](WEDDING_DEPLOYMENT.md).

**Security questions?** See [WEDDING_SECURITY.md](WEDDING_SECURITY.md).

---

**Enjoy your wedding! 💍✨**
