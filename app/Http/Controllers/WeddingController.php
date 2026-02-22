<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeddingController extends Controller
{
    /**
     * Show the wedding page
     */
    public function index()
    {
        // Generate QR code URL using QR Server API (free service)
        $uploadUrl = route('wedding.upload-form');
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($uploadUrl);
        
        // Get uploaded photos
        $photos = [];
        if (Storage::disk('public')->exists('wedding-photos')) {
            $files = Storage::disk('public')->files('wedding-photos');
            // Sort by newest first
            rsort($files);
            $photos = array_map(function($file) {
                return Storage::disk('public')->url($file);
            }, $files);
            return $photos;
        }
        
        // Get config values
        $config = config('wedding');
        
        return view('wedding.index', [
            'qrCodeUrl' => $qrCodeUrl,
            'photos' => $photos,
            'weddingDate' => $config['date'],
            'weddingTime' => $config['time'],
            'venue' => $config['venue_name'],
            'venue_address' => $config['venue_address'],
            'contributionGoal' => $config['honeymoon']['goal'],
            'contributionCurrent' => $config['honeymoon']['current'],
            'currency' => $config['honeymoon']['currency'],
            'brideInfo' => $config['bride'],
            'groomInfo' => $config['groom'],
            'honeymoonInfo' => $config['honeymoon'],
        ]);
    }

    /**
     * Show upload form (for QR code access)
     */
    public function uploadForm()
    {
        return view('wedding.upload-form');
    }

    /**
     * Handle photo upload
     */
    public function upload(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('wedding-photos', $filename, 'public');

            return response()->json([
                'success' => true,
                'message' => 'Photo uploaded successfully!',
                'filename' => $filename
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to upload photo'
        ], 400);
    }

    /**
     * Get contribution progress
     */
    public function getProgress()
    {
        $config = config('wedding');
        $goal = $config['honeymoon']['goal'];
        $current = $config['honeymoon']['current'];
        
        return response()->json([
            'goal' => $goal,
            'current' => $current,
            'percentage' => round(($current / $goal) * 100, 2)
        ]);
    }
}
