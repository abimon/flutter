# Wedding Page Architecture

## System Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                    WEDDING PAGE SYSTEM ARCHITECTURE              │
└─────────────────────────────────────────────────────────────────┘

GUEST FLOW:
═════════════════════════════════════════════════════════════════

┌──────────────┐
│  Guest Device│
└──────┬───────┘
       │
       ├─── Visit /wedding ──────────────────────────┐
       │                                             │
       │                                    ┌────────▼─────────┐
       │                                    │ WeddingController│
       │                                    │   .index()       │
       │                                    └────────┬─────────┘
       │                                             │
       │                                    ┌────────▼──────────┐
       │                                    │ wedding/index.php │
       │                          ┌─────────┤                  │
       │                          │         │ Shows:           │
       │                          │         │ - Date & Venue   │
       │                          │         │ - Fundraiser Bar │
       │                          │         │ - QR Code ◄──┐   │
       │                          │         │ - Photo Gallery  │
       │                          │         └────────────────┘
       │                          │                │
       │                          └────────────────┘
       │
       └─── Scan QR Code ────────────────────────────┐
                                                     │
                                            ┌────────▼──────────┐
                                            │ /wedding/upload    │
                                            │ uploadForm()       │
                                            └────────┬───────────┘
                                                     │
                                            ┌────────▼──────────┐
                                            │wedding/upload-    │
                                            │form.blade.php     │
                                            │ Shows:            │
                                            │ - Camera Button   │
                                            │ - File Picker     │
                                            │ - Preview Area    │
                                            └────────┬───────────┘
                                                     │
       ┌─────────────────────────────────────────────┘
       │
       └─── Select/Take Photo ───────────────────────┐
                                                     │
                                            ┌────────▼──────────┐
                                            │ Upload Form       │
                                            │ (JavaScript)      │
                                            └────────┬───────────┘
                                                     │
                                            ┌────────▼──────────┐
                                            │ POST /wedding/    │
                                            │ upload            │
                                            │ upload()          │
                                            └────────┬───────────┘
                                                     │
                                            ┌────────▼──────────┐
                                            │ Store Photo       │
                                            │storage/app/public/│
                                            │wedding-photos/    │
                                            └────────┬───────────┘
                                                     │
                                            ┌────────▼──────────┐
                                            │ Redirect Back     │
                                            │ /wedding          │
                                            └────────────────────┘
```

---

## Data Flow

```
CONFIG
┌──────────────────┐
│  config/wedding  │
│     .php         │
├──────────────────┤
│ date             │
│ time             │
│ venue_*          │
│ honeymoon.*      │
│ colors.*         │
│ upload.*         │
└────────┬─────────┘
         │
         ├─────────────────────────────────────────┐
         │                                         │
    ┌────▼──────────────────────────────────┐   │
    │ WeddingController                     │   │
    │                                       │   │
    │ index()      getProgress()  upload()  │   │
    │   │             │             │       │   │
    │   │             │             │       │   │
    │   └─────────────┴─────────────┘       │   │
    │           │                           │   │
    └───────────┼───────────────────────────┘   │
                │                               │
    ┌───────────▼──────────────────────────┐   │
    │ VIEWS                                │   │
    │                                      │   │
    │ wedding/index.blade.php              │◄──┤
    │   - Displays all config data         │   │
    │   - Shows photo gallery              │   │
    │   - Shows QR code                    │   │
    │                                      │   │
    │ wedding/upload-form.blade.php        │   │
    │   - Upload interface                 │   │
    │   - Camera/file selection            │   │
    └──────────────┬───────────────────────┘   │
                   │                           │
                   └───────────────────────────┘
                      Both use config data
```

---

## Photo Upload & Storage Flow

```
UPLOAD PROCESS
═════════════════════════════════════════════════════════════════

Client                    Server                  Storage
────────────────────────────────────────────────────────────────

[Select Photo]
      │
[Preview Photo]
      │
[Click Upload]
      │
      └──── POST /wedding/upload ────────┐
                  (FormData)              │
                                    ┌─────▼───────────────┐
                                    │ WeddingController   │
                                    │ upload()            │
                                    │                     │
                                    │ 1. Validate file    │
                                    │ 2. Check type       │
                                    │ 3. Check size       │
                                    │ 4. Store file       │
                                    │ 5. Return response  │
                                    └────────┬────────────┘
                                             │
                                    ┌────────▼───────────────┐
                                    │ Storage::disk('public')│
                                    │ .storeAs(...)         │
                                    │                       │
                                    │ File: storage/app/    │
                                    │ public/wedding-photos/│
                                    │ {timestamp}_{name}    │
                                    └────────┬───────────────┘
                                             │
                              ┌──────────────▼────────────────┐
                              │ JSON Response                 │
                              │ {                             │
                              │   success: true,              │
                              │   message: "Uploaded!"        │
                              │ }                             │
                              └──────────────┬────────────────┘
                                             │
      ◄──────────────────────────────────────┘
      │
[Show Success]
      │
[Auto-Refresh Page]
      │
      └──── GET /wedding ────────┐
                                 │
                        ┌────────▼──────────┐
                        │ Controller reads   │
                        │ photos from        │
                        │ storage/app/public/│
                        │ wedding-photos/    │
                        │                    │
                        │ Returns photo URLs │
                        │ to view            │
                        └────────┬───────────┘
                                 │
      ◄──────────────────────────┘
      │
[Display New Photo]
```

---

## Route Structure

```
ROOT
├── /                           (APIContoller@index)
├── /login                      (Auth routes)
├── /register                   (Auth routes)
├── /chalk                      (Chalk page)
├── /treasure                   (Treasure page)
├── /masterguide                (Master guide)
│
└── /wedding                    (Wedding Routes Group)
    ├── /                       (GET  WeddingController@index)
    ├── /upload                 (GET  WeddingController@uploadForm)
    ├── /upload                 (POST WeddingController@upload)
    └── /progress               (GET  WeddingController@getProgress)
```

---

## Database & Storage

```
┌─────────────────────────────────────────┐
│          FILE STRUCTURE                 │
└─────────────────────────────────────────┘

project/
├── app/Http/Controllers/
│   └── WeddingController.php ✨ NEW
│
├── resources/views/wedding/
│   ├── index.blade.php ✨ NEW
│   └── upload-form.blade.php ✨ NEW
│
├── config/
│   └── wedding.php ✨ NEW
│
├── routes/
│   └── web.php (UPDATED) ✨
│
├── storage/app/public/
│   └── wedding-photos/        (Photo storage)
│
└── Documentation/
    ├── WEDDING_QUICK_START.md ✨ NEW
    ├── WEDDING_PAGE_README.md ✨ NEW
    ├── WEDDING_SECURITY.md ✨ NEW
    └── SETUP_SUMMARY.md ✨ NEW
```

---

## Component Interaction

```
┌─────────────────────────────────────────────────────────────┐
│                    COMPONENT DIAGRAM                        │
└─────────────────────────────────────────────────────────────┘

                    WeddingController
                           │
        ┌──────────────┬────┼────┬───────────────┐
        │              │         │               │
        ▼              ▼         ▼               ▼
    index()        upload()  uploadForm()   getProgress()
        │              │         │               │
        │              │         │               │
    ┌───┴──┐      ┌─────┴───┐  └────┬────┐     │
    │      │      │         │       │    │     │
    ▼      ▼      ▼         ▼       ▼    ▼     ▼
   cfg    QRCode File    Storage  View View  JSON
wedding.│   Validate   Upload   Upload Form Data
  php   │   Storage
        │
        └──► View Rendering
             &
             Response


┌──────────────────────────────────────────────────────────┐
│               WEDDING PAGE (MAIN)                        │
│                                                          │
│  ┌────────────────────────────────────────────────────┐ │
│  │ Header                                             │ │
│  │ "Our Wedding Day"                                  │ │
│  └────────────────────────────────────────────────────┘ │
│                                                          │
│  ┌────────────┐  ┌──────────────┐                       │
│  │ Date/Time  │  │ Venue        │                       │
│  │ & Location │  │ Information  │                       │
│  └────────────┘  └──────────────┘                       │
│                                                          │
│  ┌────────────┐  ┌──────────────┐                       │
│  │ Progress   │  │ QR Code      │                       │
│  │ Tracker    │  │ Scanner      │                       │
│  └────────────┘  └──────────────┘                       │
│                                                          │
│  ┌──────────────────────────────────────────────────┐  │
│  │ Photo Gallery (Auto-Refreshing)                  │  │
│  │ ┌────────┐ ┌────────┐ ┌────────┐ ┌────────┐    │  │
│  │ │ Photo  │ │ Photo  │ │ Photo  │ │ Photo  │    │  │
│  │ │  1     │ │  2     │ │  3     │ │  4     │    │  │
│  │ └────────┘ └────────┘ └────────┘ └────────┘    │  │
│  └──────────────────────────────────────────────────┘  │
└──────────────────────────────────────────────────────────┘
```

---

## Security Flow

```
┌──────────────┐
│ Upload Form  │
│ (Client)     │
└──────┬───────┘
       │
       └─── Submit (CSRF Token) ──┐
                                   │
                           ┌───────▼──────────┐
                           │ CSRF Validation  │
                           │ Middleware       │
                           └───────┬──────────┘
                                   │
                           ┌───────▼──────────┐
                           │ File Validation  │
                           │ - Type check     │
                           │ - Size check     │
                           │ - Format check   │
                           └───────┬──────────┘
                                   │
                           ┌───────▼──────────┐
                           │ Store Securely   │
                           │ Outside public/  │
                           │ With permissions │
                           └───────┬──────────┘
                                   │
                           ┌───────▼──────────┐
                           │ Return to Client │
                           │ Success Response │
                           └──────────────────┘
```

---

This diagram shows how all components work together to provide your wedding photo gallery!
