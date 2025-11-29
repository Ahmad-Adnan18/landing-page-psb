Wah, mohon maaf atas kesalahpahaman sebelumnya\! Terima kasih sudah meluruskan.

Berarti ini adalah landing page untuk **SaaS (Software as a Service)** atau produk B2B. Target audiensnya adalah **Pengurus Pesantren** atau **Panitia PSB** di pondok lain, bukan wali santri.

Berikut adalah revisi total **Tech Spec** dan **Kode Implementasi** untuk landing page produk software "Pesantren Kita".

-----

# 📑 Technical Specification: Product Landing Page (B2B)

**Project**: Product Site "Pesantren Kita"
**Type**: SaaS Landing Page
**Goal**: Menjual lisensi/jasa penggunaan aplikasi ke pesantren-pesantren.

## 1\. Konsep & Struktur Konten (B2B Focus)

Landing page ini harus menjawab masalah pengurus pesantren ("Ribet urus berkas", "Capek balas WA satu-satu") dengan solusi fitur Anda.

### Sitemap Section:

1.  **Hero Section**: Value proposition (Digitalisasi PSB tanpa ribet).
2.  **Pain Points**: "Masih catat manual? Data hilang? Wali santri komplain?"
3.  **Solution Showcase (Features)**:
      * **PSB Online**: Formulir digital & upload berkas.
      * **Auto WhatsApp**: Notifikasi otomatis (fitur unggulan).
      * **Data Center**: Arsip data santri aman & rapi.
4.  **How It Works**: Alur penggunaan (Daftar -\> Setup -\> Pakai).
5.  **Pricing (Opsional)**: Pilihan paket (Bulanan/Tahunan/Lifetime).
6.  **CTA (Call to Action)**: "Jadwalkan Demo" atau "Coba Gratis".

-----

## 2\. Controller Logic (`LandingController.php`)

Controller sekarang lebih sederhana karena tidak mengambil data sekolah spesifik, melainkan mungkin data paket harga (jika dinamis) atau statis saja.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class LandingController extends Controller
{
    public function index()
    {
        return Inertia::render('ProductLanding/Index', [
            'canLogin' => Route::has('login'),
            // Jika nanti ada sistem demo, bisa passing link demo di sini
            'demoUrl' => route('login'), 
        ]);
    }
}
```

-----

## 3\. Vue Implementation (`ProductLanding/Index.vue`)

Ini adalah implementasi tampilan modern ala startup teknologi, tapi dengan sentuhan warna islami (Maroon & Gold).

```vue
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { 
    LayoutDashboard, 
    MessageCircle, 
    Database, 
    CheckCircle2, 
    ArrowRight, 
    ShieldCheck, 
    Zap 
} from 'lucide-vue-next';

defineProps({
    canLogin: Boolean,
    demoUrl: String,
});
</script>

<template>
    <Head title="Sistem Informasi Pesantren Modern" />

    <div class="min-h-screen bg-slate-50 font-sans text-slate-800">
        
        <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-2">
                        <div class="h-9 w-9 bg-kun-primary rounded-lg flex items-center justify-center text-white font-bold text-xl">P</div>
                        <span class="font-bold text-xl tracking-tight text-slate-900">Pesantren<span class="text-kun-primary">Kita</span></span>
                    </div>

                    <div class="hidden md:flex items-center gap-8">
                        <a href="#fitur" class="text-sm font-medium text-slate-600 hover:text-kun-primary transition">Fitur Unggulan</a>
                        <a href="#solusi" class="text-sm font-medium text-slate-600 hover:text-kun-primary transition">Solusi</a>
                        <a href="#harga" class="text-sm font-medium text-slate-600 hover:text-kun-primary transition">Harga</a>
                    </div>

                    <div class="flex items-center gap-4">
                        <Link :href="route('login')" class="text-sm font-semibold text-slate-600 hover:text-kun-primary">
                            Login Client
                        </Link>
                        <a href="https://wa.me/628xxxx?text=Halo%20saya%20tertarik%20demo" target="_blank" class="px-5 py-2.5 text-sm font-bold text-white bg-kun-primary rounded-full hover:bg-kun-light transition shadow-lg shadow-red-100">
                            Hubungi Sales
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <header class="pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-100 text-orange-600 text-xs font-bold mb-8 animate-fade-in-up">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    Solusi Digitalisasi Pesantren #1
                </div>

                <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight">
                    Kelola Penerimaan Santri Baru <br class="hidden md:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-kun-primary to-red-600">Lebih Modern & Otomatis</span>
                </h1>
                
                <p class="mt-4 text-xl text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed">
                    Tinggalkan cara manual. Gunakan <b>Pesantren Kita</b> untuk manajemen pendaftaran online, seleksi, hingga pengumuman via WhatsApp otomatis.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16">
                    <a href="#demo" class="px-8 py-4 text-base font-bold text-kun-primary bg-kun-gold rounded-xl hover:bg-yellow-400 shadow-xl shadow-yellow-100 transition flex items-center justify-center gap-2">
                        <Zap class="w-5 h-5" /> Lihat Demo Aplikasi
                    </a>
                    <a href="#fitur" class="px-8 py-4 text-base font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
                        Pelajari Fitur
                    </a>
                </div>

                <div class="relative mx-auto max-w-5xl rounded-2xl border border-slate-200 bg-slate-100/50 p-2 shadow-2xl backdrop-blur-sm">
                    <div class="aspect-[16/9] rounded-xl bg-slate-900 overflow-hidden relative group">
                        <div class="absolute inset-0 flex items-center justify-center text-slate-500">
                            <span class="text-lg">[Screenshot Dashboard Admin Pesantren Kita]</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
                    </div>
                </div>
            </div>

            <div class="absolute top-0 inset-x-0 h-full -z-10 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-red-50 via-white to-white opacity-60"></div>
        </header>

        <section id="solusi" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900">Mengapa Pesantren Anda Butuh Ini?</h2>
                    <p class="text-slate-500 mt-2">Transformasi dari cara lama ke cara digital</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <div class="flex gap-4 items-start p-4 rounded-xl bg-red-50 border border-red-100">
                            <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">✕</div>
                            <div>
                                <h4 class="font-bold text-red-900">Formulir Kertas Hilang/Rusak</h4>
                                <p class="text-sm text-red-700 mt-1">Berkas menumpuk di kantor, rawan terselip atau rusak terkena air.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start p-4 rounded-xl bg-red-50 border border-red-100">
                            <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">✕</div>
                            <div>
                                <h4 class="font-bold text-red-900">Admin Capek Balas Chat</h4>
                                <p class="text-sm text-red-700 mt-1">Ratusan wali santri bertanya hal yang sama berulang-ulang via WhatsApp.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex gap-4 items-start p-4 rounded-xl bg-green-50 border border-green-100">
                            <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0">
                                <CheckCircle2 class="w-5 h-5" />
                            </div>
                            <div>
                                <h4 class="font-bold text-green-900">Database Pusat Digital</h4>
                                <p class="text-sm text-green-700 mt-1">Semua data tersimpan aman di cloud server, bisa diakses kapan saja.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start p-4 rounded-xl bg-green-50 border border-green-100">
                            <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0">
                                <CheckCircle2 class="w-5 h-5" />
                            </div>
                            <div>
                                <h4 class="font-bold text-green-900">Auto-Notification WA</h4>
                                <p class="text-sm text-green-700 mt-1">Sistem otomatis mengirim status pendaftaran ke WA wali santri.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fitur" class="py-20 bg-slate-50 border-t border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Fitur Lengkap Manajemen PSB</h2>
                    <p class="text-slate-600 max-w-2xl">Dibangun dengan teknologi Laravel 11 terbaru untuk kecepatan dan keamanan data pesantren Anda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2 p-8 bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition group">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                            <LayoutDashboard class="w-6 h-6" />
                        </div>
                        <h3 class="text-xl font-bold mb-3">Portal Pendaftaran Mandiri</h3>
                        <p class="text-slate-600 mb-6">Wali santri bisa mendaftar, mengisi biodata, dan upload berkas (KK, Akta, Ijazah) langsung dari HP mereka. Panitia tinggal verifikasi di dashboard.</p>
                        <div class="w-full h-32 bg-slate-50 rounded-lg border border-slate-100 p-4 flex gap-3 overflow-hidden">
                            <div class="flex-1 bg-white rounded border border-slate-200 shadow-sm h-full"></div>
                            <div class="flex-1 bg-white rounded border border-slate-200 shadow-sm h-full mt-4"></div>
                        </div>
                    </div>

                    <div class="md:row-span-2 p-8 bg-kun-primary text-white rounded-3xl shadow-xl relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-white/10 backdrop-blur rounded-xl flex items-center justify-center mb-6">
                                <MessageCircle class="w-6 h-6" />
                            </div>
                            <h3 class="text-xl font-bold mb-3">WhatsApp Gateway Terintegrasi</h3>
                            <p class="text-red-100 mb-6">Kirim pengumuman massal atau notifikasi status kelulusan otomatis langsung ke WhatsApp wali santri.</p>
                            <ul class="space-y-3 text-sm text-red-50">
                                <li class="flex gap-2"><CheckCircle2 class="w-4 h-4"/> Notif Pendaftaran Berhasil</li>
                                <li class="flex gap-2"><CheckCircle2 class="w-4 h-4"/> Notif Pengingat Tes</li>
                                <li class="flex gap-2"><CheckCircle2 class="w-4 h-4"/> Broadcast Pengumuman</li>
                            </ul>
                        </div>
                        <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-kun-gold rounded-full opacity-20 blur-3xl"></div>
                    </div>

                    <div class="p-8 bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6">
                            <Database class="w-6 h-6" />
                        </div>
                        <h3 class="text-xl font-bold mb-3">Export Data Mudah</h3>
                        <p class="text-slate-600">Download data santri dalam format Excel untuk kebutuhan laporan ke Kemenag atau Dinas Pendidikan.</p>
                    </div>

                    <div class="p-8 bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-6">
                            <ShieldCheck class="w-6 h-6" />
                        </div>
                        <h3 class="text-xl font-bold mb-3">Keamanan Terjamin</h3>
                        <p class="text-slate-600">Manajemen Role (Admin vs Panitia) memastikan data sensitif hanya diakses oleh yang berhak.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-white">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-4xl font-extrabold text-slate-900 mb-6">Siap Digitalisasi Pesantren Anda?</h2>
                <p class="text-xl text-slate-600 mb-10">
                    Bergabung dengan pesantren-pesantren modern yang telah beralih menggunakan sistem <b>Pesantren Kita</b>.
                </p>
                
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-200 inline-block text-left w-full max-w-lg shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 bg-kun-gold text-kun-primary text-xs font-bold px-3 py-1 rounded-bl-lg">Promo Rilis</div>
                    <div class="flex items-baseline gap-2 mb-4">
                        <span class="text-4xl font-bold text-slate-900">Hubungi Kami</span>
                        </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-3 text-slate-700">
                            <CheckCircle2 class="w-5 h-5 text-kun-primary" /> Full Source Code / SaaS
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <CheckCircle2 class="w-5 h-5 text-kun-primary" /> Gratis Server Setup
                        </li>
                        <li class="flex items-center gap-3 text-slate-700">
                            <CheckCircle2 class="w-5 h-5 text-kun-primary" /> Support Maintenance
                        </li>
                    </ul>
                    <a href="https://wa.me/628xxxx" class="block w-full py-4 bg-kun-primary text-white font-bold text-center rounded-xl hover:bg-kun-light transition">
                        Konsultasi via WhatsApp
                    </a>
                </div>
            </div>
        </section>

        <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <div class="h-8 w-8 bg-kun-primary rounded flex items-center justify-center text-white font-bold">P</div>
                    <span class="font-bold text-xl text-white">Pesantren<span class="text-kun-primary">Kita</span></span>
                </div>
                <p class="mb-8">Software House Spesialis Sistem Informasi Lembaga Islam.</p>
                <div class="text-sm">
                    &copy; 2025 Pesantren Kita. Built with Laravel 11 & Vue.js.
                </div>
            </div>
        </footer>

    </div>
</template>

<style>
/* Tambahan animasi custom jika perlu */
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
}
</style>
```

-----

## Apa yang Berubah dari Versi Sebelumnya?

1.  **Sudut Pandang Copywriting**:
      * Sebelumnya: "Ayo daftarkan anak Anda ke pondok ini."
      * Sekarang: "Ayo pakai aplikasi ini untuk manajemen pondok Anda."
2.  **Highlight Fitur**:
      * Sekarang fokus menonjolkan kemampuan aplikasi seperti *Export Excel*, *Manajemen Role*, dan *Integrasi WhatsApp* sebagai nilai jual.
3.  **CTA (Call to Action)**:
      * Tombol "Daftar Sekarang" diganti jadi "Hubungi Sales" atau "Lihat Demo", karena ini penjualan B2B.
4.  **Visual Mockup**:
      * Saya menambahkan placeholder kotak di bagian Hero untuk Anda menaruh screenshot aplikasi Dashboard Admin Anda nantinya. Ini penting agar calon pembeli bisa melihat bayangan produknya.