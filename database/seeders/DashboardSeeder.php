<?php

namespace Database\Seeders;

use App\Models\PengaturanWeb;
use App\Models\ContactPerson;
use App\Models\Testimoni;
use App\Models\PricingPackage;
use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pengaturan Web
        PengaturanWeb::updateOrCreate(
            ['id' => 1],
            [
                'nama_lembaga' => 'Pesantren Kita',
                'slogan' => 'Sistem Informasi Pesantren Modern',
                'deskripsi' => 'Software House Spesialis Sistem Informasi Lembaga Islam. Menyediakan solusi digital untuk manajemen pesantren modern.',
                'alamat_lengkap' => 'Jl. Teknologi No. 123, Jakarta Selatan',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '12345',
                'telepon' => '+62 812-3456-7890',
                'email' => 'info@pesantrenkita.id',
                'website' => 'https://pesantrenkita.id',
                'logo_url' => null,
                'hero_image_url' => null,
                'cta_text' => 'Konsultasi via WhatsApp',
                'cta_link' => 'https://wa.me/6281234567890?text=Halo%20saya%20tertarik%20dengan%20Pesantren%20Kita',
                'is_aktif' => true,
            ]
        );

        // Contact Persons
        $contactPersons = [
            [
                'nama_lengkap' => 'Ahmad Fadillah',
                'jabatan' => 'CEO & Founder',
                'telepon' => '+62 812-3456-7890',
                'email' => 'ahmad@pesantrenkita.id',
                'whatsapp' => '+62 812-3456-7890',
                'bio' => 'Berpengalaman 10+ tahun di bidang edutech dan sistem informasi pendidikan.',
                'foto_url' => null,
                'urutan' => 1,
                'is_aktif' => true,
            ],
            [
                'nama_lengkap' => 'Sarah Mustika',
                'jabatan' => 'Head of Sales',
                'telepon' => '+62 813-4567-8901',
                'email' => 'sarah@pesantrenkita.id',
                'whatsapp' => '+62 813-4567-8901',
                'bio' => 'Spesialis konsultasi kebutuhan digitalisasi untuk lembaga pendidikan Islam.',
                'foto_url' => null,
                'urutan' => 2,
                'is_aktif' => true,
            ],
        ];

        foreach ($contactPersons as $contact) {
            ContactPerson::updateOrCreate(['email' => $contact['email']], $contact);
        }

        // Testimonis
        $testimonis = [
            [
                'nama_pesantren' => 'Pondok Pesantren Al-Hikmah',
                'nama_pemberi_testimoni' => 'Ustadz Ahmad Thohir',
                'jabatan' => 'Pengurus Yayasan',
                'isi_testimoni' => 'Aplikasi Pesantren Kita sangat membantu mempermudah proses PSB kami. Tidak lagi ribet dengan berkas kertas yang berserakan. Sangat direkomendasikan!',
                'rating' => 5,
                'foto_url' => null,
                'tanggal_testimoni' => '2024-10-15',
                'is_verified' => true,
                'urutan' => 1,
                'is_aktif' => true,
            ],
            [
                'nama_pesantren' => 'Pesantren Modern Nurul Ihsan',
                'nama_pemberi_testimoni' => 'Ibu Hj. Siti Nurjanah',
                'jabatan' => 'Ketua Panitia PSB',
                'isi_testimoni' => 'Fitur WhatsApp Gateway-nya luar biasa! Orang tua santri jadi tahu status pendaftaran tanpa harus bertanya terus menerus. Panitia pun jadi lebih fokus ke seleksi.',
                'rating' => 5,
                'foto_url' => null,
                'tanggal_testimoni' => '2024-09-20',
                'is_verified' => true,
                'urutan' => 2,
                'is_aktif' => true,
            ],
        ];

        foreach ($testimonis as $testimoni) {
            Testimoni::updateOrCreate(['nama_pesantren' => $testimoni['nama_pesantren'], 'nama_pemberi_testimoni' => $testimoni['nama_pemberi_testimoni']], $testimoni);
        }

        // Pricing Packages
        $pricingPackages = [
            [
                'nama_paket' => 'Startup',
                'deskripsi' => 'Paket dasar untuk pesantren yang memulai digitalisasi',
                'harga' => 2990000,
                'periode' => 'bulanan',
                'fitur' => ['Hingga 100 santri', 'Dashboard Admin', 'Formulir Pendaftaran Digital', 'Upload Berkas Online', 'Export Data Excel'],
                'is_populer' => false,
                'cta_text' => 'Pilih Paket',
                'cta_link' => 'https://wa.me/6281234567890?text=Saya%20mau%20paket%20Startup',
                'urutan' => 1,
                'is_aktif' => true,
            ],
            [
                'nama_paket' => 'Professional',
                'deskripsi' => 'Paket lengkap untuk pesantren yang berkembang pesat',
                'harga' => 4990000,
                'periode' => 'bulanan',
                'fitur' => ['Hingga 500 santri', 'Semua fitur Startup', 'WhatsApp Gateway', 'Notifikasi Otomatis', 'Multi User Access', 'Support Prioritas'],
                'is_populer' => true,
                'cta_text' => 'Pilih Paket',
                'cta_link' => 'https://wa.me/6281234567890?text=Saya%20mau%20paket%20Professional',
                'urutan' => 2,
                'is_aktif' => true,
            ],
            [
                'nama_paket' => 'Enterprise',
                'deskripsi' => 'Paket premium untuk pesantren besar dengan kebutuhan khusus',
                'harga' => 9990000,
                'periode' => 'bulanan',
                'fitur' => ['Santri tidak terbatas', 'Semua fitur Professional', 'Custom Development', 'Dedicated Server', 'Training On-site', 'SLA Guarantee'],
                'is_populer' => false,
                'cta_text' => 'Hubungi Sales',
                'cta_link' => 'https://wa.me/6281234567890?text=Saya%20mau%20paket%20Enterprise',
                'urutan' => 3,
                'is_aktif' => true,
            ],
        ];

        foreach ($pricingPackages as $package) {
            PricingPackage::updateOrCreate(['nama_paket' => $package['nama_paket']], $package);
        }
    }
}
