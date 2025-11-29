<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LandingController;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::orderBy('created_at', 'desc')->get();
        
        return Inertia::render('Admin/Testimoni/Index', [
            'testimoni' => $testimoni
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Testimoni/Create');
    }

    public function store(Request $request)
    {
        if (!$request->hasFile('foto')) {
            $request->request->remove('foto');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'konten' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_aktif' => 'boolean',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto_url'] = $this->storePhoto($request->file('foto'));
            unset($validated['foto']);
        } else {
            unset($validated['foto']);
        }

        Testimoni::create($validated);
        LandingController::clearLandingCache();

        return redirect()->route('admin.testimoni')
            ->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function edit(Testimoni $testimoni)
    {
        return Inertia::render('Admin/Testimoni/Edit', [
            'testimoni' => $testimoni
        ]);
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        if (!$request->hasFile('foto')) {
            $request->request->remove('foto');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'konten' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_aktif' => 'boolean',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $this->deletePhoto($testimoni->foto_url);
            $validated['foto_url'] = $this->storePhoto($request->file('foto'));
            unset($validated['foto']);
        } else {
            unset($validated['foto']);
        }

        $testimoni->update($validated);
        LandingController::clearLandingCache();

        return redirect()->route('admin.testimoni')
            ->with('success', 'Testimoni berhasil diupdate');
    }

    public function destroy(Testimoni $testimoni)
    {
        $this->deletePhoto($testimoni->foto_url);
        $testimoni->delete();
        LandingController::clearLandingCache();

        return redirect()->route('admin.testimoni')
            ->with('success', 'Testimoni berhasil dihapus');
    }

    public function toggle(Request $request, Testimoni $testimoni)
    {
        $testimoni->update([
            'is_aktif' => $request->is_aktif
        ]);
        LandingController::clearLandingCache();

        return redirect()->back()
            ->with('success', 'Status testimoni berhasil diupdate');
    }

    private function storePhoto($file): string
    {
        $path = $file->store('testimoni', 'public');
        return Storage::url($path);
    }

    private function deletePhoto(?string $url): void
    {
        if (!$url) {
            return;
        }

        $path = parse_url($url, PHP_URL_PATH) ?? $url;
        $path = ltrim(str_replace('/storage/', '', $path), '/');
        Storage::disk('public')->delete($path);
    }
}
