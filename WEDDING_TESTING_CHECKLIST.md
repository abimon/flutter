# 🧪 Wedding Page - Testing Checklist

## Pre-Launch Testing

Run through this checklist before sharing your wedding page with guests.

---

## ✅ Installation & Setup Tests

### Storage Setup
- [ ] Run `php artisan storage:link` 
- [ ] Verify symlink created: `storage/app/public/` → `public/storage`
- [ ] Check file permissions: `chmod 755 storage/app/public/`

### Configuration
- [ ] Edit `config/wedding.php` with correct details
- [ ] Verify all dates are correct (YYYY-MM-DD format)
- [ ] Confirm venue address is complete
- [ ] Check fundraising amounts are accurate
- [ ] Update currency if needed

### Cache Clearing
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan cache:clear`

---

## 🌐 Browser & Device Tests

### Desktop Browser Tests

#### Chrome
- [ ] Visit `http://localhost/wedding` or `yoursite.com/wedding`
- [ ] Page loads without errors
- [ ] All text is visible and readable
- [ ] Images display correctly
- [ ] Colors match your wedding theme
- [ ] QR code displays clearly
- [ ] Links work (Get Directions button)

#### Firefox
- [ ] Page displays correctly
- [ ] No styling issues
- [ ] Form elements work

#### Safari
- [ ] Page responsive
- [ ] No errors in console
- [ ] Mobile viewport works

#### Edge
- [ ] Page renders correctly
- [ ] No compatibility issues

### Mobile Browser Tests

#### iPhone (iOS)
- [ ] Visit page in Safari
- [ ] Responsive layout adapts to screen
- [ ] Touch buttons work
- [ ] QR code visible and scannable
- [ ] Upload form accessible
- [ ] Camera button works
- [ ] File selection works

#### Android (Chrome)
- [ ] Page responsive
- [ ] Touch UI works
- [ ] Camera access works
- [ ] File picker works

#### Tablet (iPad/Android Tablet)
- [ ] Layout optimized for tablet size
- [ ] No horizontal scrolling needed
- [ ] Touch targets large enough

---

## 📸 Photo Upload Tests

### Desktop Upload
- [ ] Click "Upload Photos" button
- [ ] Redirects to `/wedding/upload`
- [ ] File picker works
- [ ] Drag & drop area visible
- [ ] Drag test file over area
- [ ] Upload starts
- [ ] Progress indicator shows
- [ ] Success message displays
- [ ] Redirects back to main page

### Mobile Camera Test
- [ ] Visit upload page on phone
- [ ] Click "📷 Take Photo" button
- [ ] Camera app launches
- [ ] Can take photo
- [ ] Returns to upload page
- [ ] Photo preview shows correctly
- [ ] Can upload successfully

### Mobile File Selection Test
- [ ] Click "🖼️ Choose File" button
- [ ] Photo library opens
- [ ] Can select photo
- [ ] Preview displays
- [ ] Upload works

### File Validation Tests
- [ ] Upload JPEG ✓
- [ ] Upload PNG ✓
- [ ] Upload GIF ✓
- [ ] Upload JPG ✓
- [ ] Try upload TXT file ✓ (Should fail)
- [ ] Try upload PDF file ✓ (Should fail)
- [ ] Try 2MB file ✓ (Should succeed)
- [ ] Try 15MB file ✓ (Should fail - exceeds 10MB limit)

---

## ⚙️ Functionality Tests

### Wedding Details Display
- [ ] Date displays correctly
- [ ] Time displays correctly
- [ ] Venue name shows
- [ ] Address shows completely
- [ ] Address format is readable

### Progress Tracker
- [ ] Shows current amount
- [ ] Shows goal amount
- [ ] Progress bar displays
- [ ] Percentage calculates correctly
- [ ] Currency symbol correct

### QR Code
- [ ] QR code image visible
- [ ] QR code is square (300x300)
- [ ] Can scan with phone camera
- [ ] Leads to `/wedding/upload`
- [ ] URL is correct and accessible

### Photo Gallery
- [ ] Gallery displays (or "no photos" message)
- [ ] Uploaded photo appears after upload
- [ ] Photos are properly sized
- [ ] No distortion or cropping
- [ ] Gallery auto-refreshes (check in 30+ seconds)

### Quick Action Buttons
- [ ] "Upload Photos" button works
- [ ] "Get Directions" button works
- [ ] Google Maps opens with correct address

---

## 🔄 Auto-Refresh Test

- [ ] Open main page in one browser
- [ ] Open upload page in another browser/device
- [ ] Upload photo
- [ ] Wait for page to auto-refresh (max 30 seconds)
- [ ] New photo appears in gallery
- [ ] Multiple uploads show in correct order (newest first)

---

## 🔐 Security Tests

### CSRF Protection
- [ ] Invalid CSRF token rejected
- [ ] Valid uploads include token
- [ ] Form has `@csrf` field

### File Type Validation
- [ ] Only images accepted
- [ ] Non-image files rejected with message
- [ ] Rejected files don't cause errors

### File Size Validation
- [ ] Large files rejected (>10MB)
- [ ] Error message displayed
- [ ] Server doesn't crash

### Error Handling
- [ ] Network errors show message
- [ ] Invalid file shows error
- [ ] Graceful error recovery

---

## 📱 Mobile-Specific Tests

### Viewport Tests
- [ ] Page fits on 320px screen (iPhone SE)
- [ ] Page fits on 375px screen (iPhone)
- [ ] Page fits on 667px screen (iPhone Plus)
- [ ] Page fits on 768px (iPad)
- [ ] No horizontal scrolling needed
- [ ] Text is readable without zoom

### Touch Tests
- [ ] Buttons tap-able (min 44x44px)
- [ ] Links easy to click
- [ ] Forms easy to use
- [ ] No hover elements blocking content

### Performance Tests
- [ ] Page loads in <3 seconds on 4G
- [ ] Page loads in <5 seconds on 3G
- [ ] Images load lazy (don't block page)
- [ ] Camera access doesn't hang

---

## 🔗 API Tests

### Progress Endpoint
```bash
curl http://yoursite.com/wedding/progress
```

Expected response:
```json
{
  "goal": 500000,
  "current": 325000,
  "percentage": 65.00
}
```

Tests:
- [ ] Endpoint returns valid JSON
- [ ] Percentage calculates correctly
- [ ] Values match config

---

## 🗂️ File & Permissions Tests

### File Existence
- [ ] `app/Http/Controllers/WeddingController.php` exists
- [ ] `resources/views/wedding/index.blade.php` exists
- [ ] `resources/views/wedding/upload-form.blade.php` exists
- [ ] `config/wedding.php` exists
- [ ] `routes/web.php` updated with wedding routes
- [ ] call center route (`/wedding/call-center`) works and requires phone number
- [ ] contributions page shows list to authenticated users
- [ ] only user with role "treasurer" can add/edit/delete contributions

### Storage Directory
- [ ] `storage/app/public/` directory exists
- [ ] `storage/app/public/wedding-photos/` created
- [ ] Directory is writable (755 permissions)
- [ ] Public symlink created at `public/storage`

### Uploaded Files
- [ ] Photos stored at `storage/app/public/wedding-photos/`
- [ ] Can access at `yoursite.com/storage/wedding-photos/filename`
- [ ] File names show timestamp (e.g., `1624520391_photo.jpg`)
- [ ] File meta preserved (size, type)

---

## 🎨 Visual/UX Tests

### Styling & Layout
- [ ] Colors match wedding theme
- [ ] Font sizes are readable
- [ ] Spacing is balanced
- [ ] Cards have proper shadows
- [ ] Gradient background displays
- [ ] Hover effects work on desktop

### Animations
- [ ] Fade-in animations on load
- [ ] Smooth hover transitions
- [ ] Photo zoom on hover
- [ ] Loading spinner animates

### Color Scheme
- [ ] Primary color (indigo) correct
- [ ] Secondary color (purple) correct
- [ ] Text contrast meets accessibility needs
- [ ] Links are understandable

### Responsiveness
- [ ] Test at 320px width (mobile)
- [ ] Test at 768px width (tablet)
- [ ] Test at 1024px width (desktop)
- [ ] Test at 1920px width (large desktop)
- [ ] All layouts readable

---

## ⚡ Performance Tests

### Page Load Speed
- [ ] Desktop: <2 seconds
- [ ] Mobile 4G: <3 seconds
- [ ] Mobile 3G: <5 seconds

### Image Optimization
- [ ] Uploaded images reasonable size
- [ ] Gallery doesn't lag with many photos
- [ ] Image lazy-loading works (if configured)

### Memory Usage
- [ ] Page doesn't freeze browser
- [ ] Smooth scrolling
- [ ] No memory leaks on refresh

---

## 🌍 Compatibility Tests

### Different Environments
- [ ] Works on localhost
- [ ] Works on staging domain
- [ ] Works on production domain
- [ ] Works with HTTPS
- [ ] Works with custom domain

### Laravel Versions
- [ ] Works with installed Laravel version
- [ ] Config file properly loaded
- [ ] Routes properly registered
- [ ] Views properly renders

---

## 📝 Edge Cases

### Boundary Tests
- [ ] Maximum file size (10MB) succeeds
- [ ] Just over maximum (10.1MB) fails
- [ ] Zero byte file fails
- [ ] Exactly 1 byte succeeds

### Empty States
- [ ] No photos message displays when gallery empty
- [ ] Page works first time (no photos)
- [ ] Still works with 1 photo
- [ ] Works with 100+ photos

### User Flow
- [ ] Can upload without account
- [ ] Can upload multiple times
- [ ] Can refresh page after upload
- [ ] QR link works every time

---

## 🚫 Negative Tests

### What Should Fail
- [ ] Non-image files rejected ✓
- [ ] Files >10MB rejected ✓
- [ ] Invalid CSRF token rejected ✓
- [ ] Direct storage folder access blocked ✓
- [ ] Executing uploaded files blocked ✓

### Error Messages
- [ ] All errors have user-friendly messages
- [ ] No technical jargon in errors shown to users
- [ ] Errors suggest solutions
- [ ] Errors don't expose system details

---

## ✨ Final Checks

### Before Going Live
- [ ] All tests passed
- [ ] Staging environment tested
- [ ] Production environment ready
- [ ] Backup created
- [ ] Error logging enabled
- [ ] Monitoring set up
- [ ] Admin notified

### Wedding Day
- [ ] Page online and accessible
- [ ] QR code printed and available
- [ ] Tested from poor WiFi
- [ ] Phone battery checked
- [ ] Backup phone available
- [ ] Contact accessible if issues

### Post-Wedding
- [ ] All photos downloaded
- [ ] Backups created
- [ ] Photos shared with guests
- [ ] Page kept as memory or archived
- [ ] Cleanup performed

---

## 🐛 Bug Report Template

If you find issues, document:

```
BUG REPORT
──────────────────────────────────────────
Title: [Brief description]
Date: [When found]
Environment: [Device/Browser/OS]
Step to Reproduce:
1. [First step]
2. [Second step]
3. [Expected result]
4. [Actual result]
Screenshots: [If applicable]
Error Message: [Full error text]
Browser Console: [Any errors?]
```

---

## ✅ Sign-Off

Mark as complete when all tests pass:

- [ ] All tests run and passed
- [ ] No critical issues remain
- [ ] Performance acceptable
- [ ] Team approved
- [ ] Ready for guests

**Tester Name:** ___________________  
**Date:** ___________________  
**Notes:** ___________________

---

Good luck with your wedding! The thorough testing will ensure a smooth experience for your guests! 💍✨
