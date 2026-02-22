# 🚀 Wedding Page - Deployment Guide

## Production Deployment Checklist

Complete this guide before making your wedding page live to guests.

---

## 📋 Pre-Deployment Checks

### Code Review
- [ ] Check all files are properly saved
- [ ] No debug code or `dd()` statements
- [ ] No `console.log()` statements in production
- [ ] All routes properly defined
- [ ] Controller methods complete

### Configuration
- [ ] `config/wedding.php` updated with correct details
- [ ] `.env` file configured
- [ ] `APP_DEBUG` is `false` in production
- [ ] `APP_ENV` is `production`

### Security
- [ ] `APP_KEY` is generated (run `php artisan key:generate`)
- [ ] HTTPS enabled on domain
- [ ] CSRF protection active (no disabled routes)
- [ ] No credentials in code
- [ ] No test files uploaded

### Backup
- [ ] Database backed up
- [ ] Copy of `config/wedding.php` saved
- [ ] Copy of uploaded photos backed up
- [ ] `.env` file backed up (securely)

---

## 🔧 Server Preparation

### PHP Configuration
```bash
# SSH into server
ssh user@yourserver.com

# Check PHP version (should be 8.0.2+)
php -v

# Check required extensions
php -m | grep -E "json|fileinfo|gd|curl|openssl"

# Update php.ini if needed
sudo nano /etc/php/8.1/fpm/php.ini
```

Key settings:
```ini
upload_max_filesize = 50M
post_max_size = 50M
max_execution_time = 300
memory_limit = 256M
display_errors = Off
log_errors = On
error_log = /var/log/php-errors.log
```

### Web Server Configuration

#### Nginx
```nginx
server {
    server_name yourdomain.com www.yourdomain.com;
    root /path/to/public;
    
    client_max_body_size 50M;
    
    # ... rest of config
}
```

#### Apache
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /path/to/public
    
    <Directory /path/to/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # Allow large uploads
    <IfModule mod_php.c>
        php_value upload_max_filesize 50M
        php_value post_max_size 50M
    </IfModule>
</VirtualHost>
```

### File Permissions
```bash
# Set correct permissions
chmod 755 /path/to/laravel
chmod 755 /path/to/laravel/public
chmod 755 /path/to/laravel/storage
chmod 755 /path/to/laravel/bootstrap/cache

# Web server ownership
sudo chown -R www-data:www-data /path/to/laravel/storage
sudo chown -R www-data:www-data /path/to/laravel/bootstrap/cache
sudo chown -R www-data:www-data /path/to/laravel/public/storage
```

---

## 🌍 Domain & SSL Setup

### Domain Configuration
1. [ ] Point domain DNS to server
2. [ ] Verify DNS propagation (usually 24-48 hours)
3. [ ] Configure domain in hosting control panel
4. [ ] Test domain accessibility

### SSL Certificate (HTTPS)
```bash
# Using Let's Encrypt with Certbot
sudo apt-get install certbot python3-certbot-nginx

# Generate certificate
sudo certbot certonly --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal setup (usually automatic)
sudo systemctl status certbot.timer
```

### Force HTTPS
Update `config/session.php` or middleware:
```php
'secure' => env('SESSION_SECURE_COOKIES', true),
'http_only' => true,
'same_site' => 'lax',
```

---

## 🔌 Deployment Steps

### Step 1: Clone Repository
```bash
cd /var/www
git clone https://github.com/yourrepo/wedding.git
cd wedding
```

### Step 2: Install Dependencies
```bash
# Install Composer dependencies
composer install --no-dev --optimize-autoloader

# Install NPM dependencies (if using npm)
npm install --production

# Build assets (if needed)
npm run build
```

### Step 3: Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Edit with production values
nano .env

# Generate app key
php artisan key:generate

# Set secure permissions
sudo chown -R www-data:www-data /path/to/laravel
sudo chmod -R 775 storage bootstrap/cache
```

### Step 4: Database Setup
```bash
# Run migrations (if using database features)
php artisan migrate --force

# Seed data (if needed)
php artisan db:seed
```

### Step 5: Storage Setup
```bash
# Create/link public storage
php artisan storage:link

# Verify symlink
ls -la public/ | grep storage
```

### Step 6: Optimization
```bash
# Clear and cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views (optional)
php artisan view:cache

# Optimize auto-loader
composer install --no-dev --optimize-autoloader
```

### Step 7: Permissions
```bash
# Create wedding photos directory
mkdir -p storage/app/public/wedding-photos

# Set proper permissions
sudo chown www-data:www-data storage/app/public/wedding-photos
sudo chmod 755 storage/app/public/wedding-photos
```

---

## ✅ Post-Deployment Verification

### Application Health
```bash
# Check application status
php artisan tinker
# Type: exit to exit

# Test a route
curl https://yourdomain.com/wedding

# Check logs
tail -50 storage/logs/laravel.log
```

### Feature Testing
- [ ] Visit `/wedding` - loads successfully
- [ ] QR code displays
- [ ] Upload form accessible
- [ ] Test file upload works
- [ ] Photos appear in gallery
- [ ] Auto-refresh works
- [ ] Progress API returns data

### Performance Check
```bash
# From browser DevTools or command line
# Check load time: <2 seconds ideal
# Check Largest Contentful Paint (LCP): <2.5s
# Check Cumulative Layout Shift (CLS): <0.1
```

---

## 🔒 Security Verification

### Security Headers
```bash
# Test security headers
curl -I https://yourdomain.com/wedding

# Should include (configure in web server):
# Strict-Transport-Security: max-age=31536000
# X-Content-Type-Options: nosniff
# X-Frame-Options: DENY
# Content-Security-Policy: ...
```

### SSL Certificate
```bash
# Verify SSL working
openssl s_client -connect yourdomain.com:443

# Should show certificate details without errors
```

### File Permission Audit
```bash
# Check critical files not readable
find /path/to/laravel -name ".env" -ls
# Should not be in public directory

# Check storage is writable
ls -la storage/app/public/wedding-photos/
# Should show 755 or 775 permissions
```

---

## 📊 Monitoring Setup

### Error Tracking
```bash
# Ensure logging is enabled in .env
LOG_CHANNEL=stack
LOG_LEVEL=debug

# Monitor logs in real-time
tail -f storage/logs/laravel.log
```

### Uptime Monitoring
Services to consider:
- Pingdom
- Uptime Robot
- New Relic
- DataDog

Setup instruction (example with Uptime Robot):
1. Create free account at uptimerobot.com
2. Add monitor: `https://yourdomain.com/wedding`
3. Set check interval: 5 minutes
4. Add alert email

### Performance Monitoring
```bash
# Check server resources
top -b -n 1 | head -20
free -h
df -h
```

---

## 🔄 Backup Strategy

### Automated Backups
```bash
# Create backup script (backup.sh)
#!/bin/bash

BACKUP_DIR="/backups/wedding"
LARAVEL_DIR="/var/www/wedding"
DATE=$(date +%Y%m%d_%H%M%S)

# Backup photos
tar -czf $BACKUP_DIR/photos_$DATE.tar.gz $LARAVEL_DIR/storage/app/public/wedding-photos/

# Backup config
cp $LARAVEL_DIR/config/wedding.php $BACKUP_DIR/wedding_config_$DATE.php

# Backup database (if using)
# mysqldump -u user -p database > $BACKUP_DIR/db_$DATE.sql

echo "Backup completed: $DATE"
```

Schedule with cron:
```bash
# Edit crontab
sudo crontab -e

# Add: Run backup daily at 2 AM
0 2 * * * /var/www/wedding/backup.sh
```

### Manual Backup
```bash
# Before going live
sudo tar -czf /backups/wedding_pre-launch.tar.gz /var/www/wedding/

# After wedding
sudo tar -czf /backups/wedding_post-event.tar.gz /var/www/wedding/
```

---

## 🆘 Troubleshooting Deployment

### Page Not Found
```bash
# Check routes cached incorrectly
php artisan route:clear
php artisan route:cache

# Verify .htaccess (Apache only)
cat public/.htaccess | grep -i rewrite
```

### Upload Failing
```bash
# Check storage directory exists
ls -la storage/app/public/wedding-photos/

# Fix permissions
sudo chmod -R 755 storage/app/public/
sudo chown -R www-data:www-data storage/

# Clear config cache
php artisan config:clear
```

### Photos Not Showing
```bash
# Verify symlink
ls -la public/storage

# Recreate if missing
php artisan storage:link

# Check photo access
curl https://yourdomain.com/storage/wedding-photos/test.jpg
```

### Slow Performance
```bash
# Clear app cache
php artisan cache:clear

# Check server resources
top
free -h
df -h

# Optimize database
php artisan optimize
```

---

## 📱 Live Testing

### Pre-Wedding Day Check
- [ ] Visit site from multiple devices
- [ ] Test from different networks (cellular + WiFi)
- [ ] Try upload from phone
- [ ] Verify photos appear
- [ ] Test QR code scanning
- [ ] Check performance on slow connection

### Wedding Day Monitoring
- [ ] Check logs periodically
- [ ] Monitor server resources
- [ ] Be ready for quick fixes
- [ ] Have backup access ready
- [ ] Keep admin contact available

---

## 🎉 Go-Live Announcement

### Share the Link
```
📱 Wedding Gallery: https://yourdomain.com/wedding

Join us in celebrating our special day!
```

Share on:
- Email invitations
- Wedding website
- Social media
- Text messages
- Print QR code for reception

### QR Code Distribution
1. Generate high-res QR code
2. Print for signage
3. Display on:
   - Reception tables
   - Gift table
   - Entrance
   - Program/menu cards

---

## 📊 Post-Launch Updates

### Monitor These Metrics
- Total uploads
- Daily active visitors
- Storage usage
- Server load
- Error rates
- Page load time

### Weekly Check
```bash
# Check storage usage
du -sh storage/app/public/wedding-photos/

# Check recent errors
grep -i error storage/logs/laravel.log | tail -20

# Check file count
find storage/app/public/wedding-photos -type f | wc -l
```

---

## 🧹 Post-Wedding Cleanup

### Immediate
- [ ] Download all photos
- [ ] Create multiple backups
- [ ] Verify all backups work

### Week After
- [ ] Review error logs
- [ ] Check for any issues
- [ ] Plan long-term storage

### Month After
- [ ] Archive wedding photos
- [ ] Decide if keeping page live
- [ ] Share final album with guests
- [ ] Plan page preservation

### Long-term (Optional)
```bash
# Keep as permanent memory
# Setup automated backups
# Plan annual renewal

# Or archive and remove
tar -czf final-wedding-archive.tar.gz /var/www/wedding/
# Keep secure backup for years
```

---

## 🆘 Emergency Contacts

Save important information:

**Server Admin:** ___________________  
**Domain Registrar:** ___________________  
**Hosting Provider Support:** ___________________  
**Emergency Contact:** ___________________  

---

## ✅ Final Deployment Checklist

Before announcing to guests:

- [ ] All tests passed on production
- [ ] Backups verified working
- [ ] SSL/HTTPS working
- [ ] QR code tested and printed
- [ ] Domain accessible
- [ ] Photos upload successfully
- [ ] Gallery auto-refreshes
- [ ] Mobile friendly
- [ ] Performance acceptable
- [ ] Error logging enabled
- [ ] Monitoring setup
- [ ] Support plan in place

---

Enjoy your wedding celebration! 💍✨

Your guests will love sharing their photos with this system!
