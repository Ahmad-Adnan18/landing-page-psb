<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LandingController;
use App\Models\PengaturanWeb;
use App\Models\ContactPerson;
use App\Models\Testimoni;
use App\Models\PricingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pengaturan_web' => PengaturanWeb::count(),
            'contact_persons' => ContactPerson::count(),
            'testimonis' => Testimoni::count(),
            'pricing_packages' => PricingPackage::count(),
        ];

        return Inertia::render('Admin/Dashboard/Index', [
            'stats' => $stats,
            'recentTestimonis' => Testimoni::latest()->take(5)->get(),
            'activePackages' => PricingPackage::where('is_aktif', true)->count(),
        ]);
    }

    public function pengaturanWeb()
    {
        $pengaturan = PengaturanWeb::first();
        return Inertia::render('Admin/PengaturanWeb/Index', [
            'pengaturan' => $pengaturan,
        ]);
    }

    public function updatePengaturanWeb(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat_lengkap' => 'required|string|max:500',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'cta_text' => 'required|string|max:255',
            'cta_link' => 'required|string|max:500',
            'slider_images' => 'nullable|array',
            'slider_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'kept_slider_images' => 'nullable|array',
        ]);

        $pengaturan = PengaturanWeb::firstOrNew(['id' => 1]);
        $finalImages = $request->input('kept_slider_images', $pengaturan->slider_images ?? []);

        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $image) {
                $path = $image->store('slider-images', 'public');
                $finalImages[] = '/storage/' . $path;
            }
        }

        $validated['slider_images'] = $finalImages;
        // Remove kept_slider_images from validated data as it's not a column
        unset($validated['kept_slider_images']);

        PengaturanWeb::updateOrCreate(['id' => 1], $validated);

        // Clear cache
        Cache::forget(PengaturanWeb::cacheKey());
        LandingController::clearLandingCache();

        return back()->with('success', 'Pengaturan web berhasil diperbarui!');
    }

    public function contactPersons()
    {
        $contactPersons = ContactPerson::orderBy('urutan')->get();
        return Inertia::render('Admin/ContactPersons/Index', [
            'contactPersons' => $contactPersons,
        ]);
    }

    public function storeContactPerson(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'urutan' => 'integer|min:0',
        ]);

        ContactPerson::create($validated);

        LandingController::clearLandingCache();

        return back()->with('success', 'Contact person berhasil ditambahkan!');
    }

    public function updateContactPerson(Request $request, ContactPerson $contactPerson)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'urutan' => 'integer|min:0',
        ]);

        $contactPerson->update($validated);

        LandingController::clearLandingCache();

        return back()->with('success', 'Contact person berhasil diperbarui!');
    }

    public function toggleContactPerson(ContactPerson $contactPerson)
    {
        $contactPerson->is_aktif = !$contactPerson->is_aktif;
        $contactPerson->save();

        return back()->with('success', 'Status contact person berhasil diubah!');
    }









    public function pricing()
    {
        $packages = PricingPackage::orderBy('urutan')->get();
        return Inertia::render('Admin/Pricing/Index', [
            'packages' => $packages,
        ]);
    }

    public function storePricing(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'harga_diskon' => 'nullable|numeric|min:0',
            'periode' => 'required|string|max:255',
            'fitur' => 'required|array',
            'is_populer' => 'boolean',
            'cta_text' => 'required|string|max:255',
            'cta_link' => 'nullable|string|max:500',
            'urutan' => 'integer|min:0',
        ]);

        $validated['harga_diskon'] = $request->filled('harga_diskon') ? $validated['harga_diskon'] : null;

        PricingPackage::create($validated);

        LandingController::clearLandingCache();

        return back()->with('success', 'Paket harga berhasil ditambahkan!');
    }

    public function updatePricing(Request $request, PricingPackage $package)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'harga_diskon' => 'nullable|numeric|min:0',
            'periode' => 'required|string|max:255',
            'fitur' => 'required|array',
            'is_populer' => 'boolean',
            'cta_text' => 'required|string|max:255',
            'cta_link' => 'nullable|string|max:500',
            'urutan' => 'integer|min:0',
        ]);

        $validated['harga_diskon'] = $request->filled('harga_diskon') ? $validated['harga_diskon'] : null;

        $package->update($validated);

        LandingController::clearLandingCache();

        return back()->with('success', 'Paket harga berhasil diperbarui!');
    }

    public function togglePricing(PricingPackage $package)
    {
        $package->is_aktif = !$package->is_aktif;
        $package->save();

        return back()->with('success', 'Status paket berhasil diubah!');
    }

    public function togglePopular(PricingPackage $package)
    {
        // If this is being set to popular, unset all others
        if (!$package->is_populer) {
            PricingPackage::where('is_populer', true)->update(['is_populer' => false]);
        }
        
        $package->is_populer = !$package->is_populer;
        $package->save();

        return back()->with('success', 'Status popular paket berhasil diubah!');
    }

    // Pricing Additional Methods
    public function createPricing()
    {
        return Inertia::render('Admin/Pricing/Create');
    }

    public function editPricing(PricingPackage $package)
    {
        return Inertia::render('Admin/Pricing/Edit', [
            'package' => $package,
        ]);
    }

    public function destroyPricing(PricingPackage $package)
    {
        $package->delete();
        return redirect()->route('admin.pricing')->with('success', 'Paket berhasil dihapus!');
    }

    // Testimoni Additional Methods






    // Contact Persons Additional Methods
    public function createContactPerson()
    {
        return Inertia::render('Admin/ContactPersons/Create');
    }

    public function editContactPerson(ContactPerson $contactPerson)
    {
        return Inertia::render('Admin/ContactPersons/Edit', [
            'contactPerson' => $contactPerson,
        ]);
    }

    public function destroyContactPerson(ContactPerson $contactPerson)
    {
        $contactPerson->delete();
        return redirect()->route('admin.contact-persons')->with('success', 'Contact person berhasil dihapus!');
    }
}
