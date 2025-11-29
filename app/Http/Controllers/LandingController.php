<?php

namespace App\Http\Controllers;

use App\Models\PengaturanWeb;
use App\Models\Testimoni;
use App\Models\PricingPackage;
use App\Models\ContactPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        // Cache pengaturan web for 1 hour
        $pengaturan = Cache::remember('landing_pengaturan_web', 3600, fn () => 
            PengaturanWeb::where('is_aktif', true)->first()
        );

        // Cache testimoni for 15 minutes
        $testimoni = Cache::remember('landing_testimoni', 900, fn () => 
            Testimoni::where('is_aktif', true)
                ->orderBy('created_at', 'desc')
                ->limit(6)->get()
        );

        // Cache pricing packages for 30 minutes
        $packages = Cache::remember('landing_packages', 1800, fn () => 
            PricingPackage::where('is_aktif', true)->orderBy('urutan')->get()
        );

        // Cache contact persons for 1 hour
        $contactPersons = Cache::remember('landing_contacts', 3600, fn () => 
            ContactPerson::where('is_aktif', true)->orderBy('urutan')->limit(3)->get()
        );

        return Inertia::render('ProductLanding/Index', [
            'canLogin' => Route::has('login'),
            'demoUrl' => route('login'),
            'pengaturan' => $pengaturan,
            'testimoni' => $testimoni,
            'packages' => $packages,
            'contactPersons' => $contactPersons,
        ]);
    }

    /**
     * Clear landing page cache for immediate updates
     */
    public static function clearLandingCache()
    {
        Cache::forget('landing_pengaturan_web');
        Cache::forget('landing_testimoni');
        Cache::forget('landing_packages');
        Cache::forget('landing_contacts');
    }
}
