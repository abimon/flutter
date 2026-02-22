# 🔒 Wedding Page - Security & Best Practices

## Security Features Built-In

### ✅ Protection Measures Implemented

1. **CSRF Protection**
   - All POST requests include CSRF token validation
   - Prevents unauthorized form submissions

2. **File Validation**
   - Server-side file type verification
   - File size restrictions (10MB max)
   - Only image formats accepted (JPEG, PNG, GIF, JPG)

3. **Rate Limiting** (Recommended)
   - Consider adding rate limiting for uploads through middleware
   - Prevents spam/abuse

4. **Storage Security**
   - Uploaded files stored outside public directory by default
   - Accessible through controlled storage route

---

## 🛡️ Recommended Security Enhancements

### 1. Enable HTTPS (Critical!)
```bash
# In your hosting control panel or with Let's Encrypt
# All file uploads should use HTTPS
```

**Why**: Protects data in transit, especially on mobile networks.

### 2. Add Authentication (Optional)
If you want to restrict uploads to invited guests:

```php
// In routes/web.php
Route::prefix('wedding')->middleware('auth')->group(function () {
    Route::post('/upload', [WeddingController::class, 'upload'])->name('wedding.upload');
});
```

### 3. Implement Rate Limiting

Add to controller:
```php
use Illuminate\Routing\Middleware\ThrottleRequests;

// In your route middleware
Route::post('/upload', [WeddingController::class, 'upload'])
    ->middleware('throttle:10,1')  // 10 uploads per minute
    ->name('wedding.upload');
```

### 4. Add Virus Scanning
For high-volume uploads, scan files:
```php
composer require illuminate/queue

// Then add scanning logic in upload method
```

### 5. Clean Up Old Photos (Optional)
Add scheduled cleanup of old photos:

```php
// app/Console/Kernel.php
$schedule->call(function () {
    Storage::disk('public')->delete(
        Storage::disk('public')->files('wedding-photos')
    );
})->monthly();  // Clean up monthly
```

---

## 📋 Best Practices

### For Administrators

1. **Regular Backups**
   ```bash
   # Backup uploaded photos
   cp -r storage/app/public/wedding-photos/ backups/
   ```

2. **Monitor Upload Quota**
   ```bash
   # Check disk usage
   du -sh storage/app/public/wedding-photos/
   ```

3. **Regular Cleanup**
   - Remove inappropriate photos promptly
   - Archive old photos monthly

### For Website Deployment

1. **Pre-Wedding Checklist**
   ```
   ☐ Domain configured and accessible
   ☐ HTTPS enabled
   ☐ Storage linked (php artisan storage:link)
   ☐ File permissions correct (755 on storage)
   ☐ Tested on mobile devices
   ☐ QR code verified working
   ☐ Test photo upload successful
   ☐ Page cached cleared
   ```

2. **Day-Of Checklist**
   ```
   ☐ Website online and responsive
   ☐ QR code printed and visible
   ☐ Mobile testing from poor WiFi
   ☐ Monitor uploads in real-time
   ☐ Have backup access ready
   ```

3. **Post-Wedding Checklist**
   ```
   ☐ Download all photos
   ☐ Create backups
   ☐ Share with guests
   ☐ Consider keeping page up for memories
   ☐ Plan long-term photo storage
   ```

---

## ⚙️ Server Configuration

### Recommended PHP Settings
```ini
; php.ini
upload_max_filesize = 50M
post_max_size = 50M
max_execution_time = 300
memory_limit = 256M
```

### Nginx Configuration (if applicable)
```nginx
http {
    client_max_body_size 50M;
}
```

### Apache Configuration (.htaccess)
```apache
php_value upload_max_filesize 50M
php_value post_max_size 50M
```

---

## 🚨 Privacy Considerations

### Data Protection
1. **Guest Privacy**
   - Photos are publicly accessible on the page
   - Consider adding photo moderation
   - Ask guests for permission before uploading

2. **Personal Data**
   - No personal information stored
   - Photos named by timestamp only
   - No metadata tracking

3. **Long-term Storage**
   - Decide when photos will be removed
   - Set expiration date if needed
   - Backup for personal records

### GDPR Compliance (if applicable)
```php
// Add this route to delete a photo if needed
Route::delete('/wedding/photo/{id}', [WeddingController::class, 'deletePhoto'])
    ->name('wedding.delete-photo');
```

---

## 🔍 Monitoring & Logging

### Enable Upload Logging
```php
// In WeddingController::upload()
\Log::info('Wedding photo uploaded', [
    'filename' => $filename,
    'size' => $file->getSize(),
    'ip' => request()->ip(),
    'timestamp' => now()
]);
```

### Check Application Logs
```bash
tail -f storage/logs/laravel.log
```

---

## 🚫 Common Security Mistakes to Avoid

❌ **Don't:**
- Store files in `public/` directory
- Accept all file types
- Skip file size validation
- Use HTTP instead of HTTPS
- Ignore PHP upload settings
- Keep old test files on server

✅ **Do:**
- Use `storage/` directory
- Validate file types server-side
- Limit file sizes
- Use HTTPS always
- Review PHP security settings
- Remove test/old files regularly

---

## 🔐 Security Auditing

### Run Laravel Security Check
```bash
php artisan security:check
composer require sensio/security-checker --dev
```

### Check File Permissions
```bash
# Should be readable/writable by web server
ls -la storage/app/public/wedding-photos/

# Fix permissions if needed
chmod -R 755 storage/
chmod -R 755 public/
```

### Verify CSRF Protection
- All forms include `@csrf` token ✅ (Already included)
- Middleware enabled ✅ (Default in Laravel)

---

## 📞 Incident Response

If you suspect a security issue:

1. **Take the page offline temporarily**
   ```bash
   php artisan down --message="Wedding page is being updated"
   ```

2. **Check logs**
   ```bash
   tail -200 storage/logs/laravel.log | grep -i error
   ```

3. **Review uploaded files**
   ```bash
   ls -la storage/app/public/wedding-photos/
   ```

4. **Clear cache**
   ```bash
   php artisan cache:clear
   ```

5. **Bring back online**
   ```bash
   php artisan up
   ```

---

## 🎓 Additional Resources

- [Laravel Security Documentation](https://laravel.com/docs/security)
- [OWASP File Upload Security](https://owasp.org/www-community/vulnerabilities/Unrestricted_File_Upload)
- [PHP File Upload Security](https://www.php.net/manual/en/features.file-upload.php)

---

Happy secure wedding! 💍🔒
