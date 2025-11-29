<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import { 
    LayoutDashboard, 
    MessageCircle, 
    Database, 
    CheckCircle2, 
    ArrowRight, 
    ShieldCheck, 
    Zap,
    Menu,
    X,
    ChevronRight,
    Star,
    Users,
    Phone,
    Mail,
    Globe,
    ArrowUp
} from 'lucide-vue-next';
import TextType from '@/Components/TextType.vue';
import BlurText from '@/Components/BlurText.vue';
import GooeyNav from '@/Components/GooeyNav.vue';
import RollingGallery from '@/Components/RollingGallery.vue';

const props = defineProps({
    canLogin: Boolean,
    demoUrl: String,
    pengaturan: Object,
    testimoni: Array,
    packages: Array,
    contactPersons: Array,
});

const isMenuOpen = ref(false);

const navItems = [
    { label: 'Home', href: '#home' },
    { label: 'Fitur', href: '#features' },
    { label: 'Solusi', href: '#solusi' },
    { label: 'Harga', href: '#pricing' },
    { label: 'Testimoni', href: '#testimoni' },
];

const isScrolled = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <Head title="Sistem Informasi Pesantren Modern | {{ pengaturan?.nama_lembaga || 'Pesantren Kita' }}" />

    <!-- Main Container with Red Gradient Background -->
    <div class="min-h-screen bg-gradient-to-br from-kun-primary via-[#A9262D] to-[#8B1E24] font-sans text-white overflow-hidden selection:bg-kun-gold selection:text-kun-primary">
        
        <!-- Background Shapes (Abstract) -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('/images/pattern-geometry.svg')] opacity-5"></div>
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-kun-gold/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Navigation -->
        <nav 
            class="fixed top-0 left-0 w-full z-50 transition-all duration-300" 
            :class="{ 
                'bg-kun-primary/90 backdrop-blur-md shadow-lg py-4': isScrolled || isMenuOpen,
                'bg-transparent py-6': !isScrolled && !isMenuOpen
            }"
        >
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center transition-all duration-300">
                    <!-- Logo -->
                    <div class="flex items-center gap-3">
                        <img src="/images/logo.png" alt="Logo" class="h-16 w-auto rounded-lg shadow-lg bg-white p-1" />
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:block">
                        <GooeyNav :items="navItems" />
                    </div>

                    <!-- CTA Buttons -->
                    <div class="hidden md:flex items-center gap-4">
                        <Link :href="route('login')" class="text-sm font-semibold text-white hover:text-kun-gold transition-colors">
                            Login
                        </Link>
                        <a :href="pengaturan?.cta_link || '#'" target="_blank" class="px-6 py-2.5 text-sm font-bold text-kun-primary bg-white rounded-full hover:bg-kun-gold transition shadow-lg">
                            Hubungi Kami
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button 
                        @click="isMenuOpen = !isMenuOpen" 
                        class="md:hidden p-2 text-white hover:bg-white/10 rounded-lg transition-colors"
                    >
                        <Menu v-if="!isMenuOpen" class="w-6 h-6" />
                        <X v-else class="w-6 h-6" />
                    </button>
                </div>

                <!-- Mobile Menu -->
                <div v-if="isMenuOpen" class="md:hidden py-4 border-t border-white/10">
                    <div class="flex flex-col gap-4">
                        <a href="#home" class="text-sm font-medium text-white">Home</a>
                        <a href="#features" class="text-sm font-medium text-white">Fitur</a>
                        <a href="#solusi" class="text-sm font-medium text-white">Solusi</a>
                        <a href="#pricing" class="text-sm font-medium text-white">Harga</a>
                        <a href="#testimoni" class="text-sm font-medium text-white">Testimoni</a>
                        <Link :href="route('login')" class="text-sm font-semibold text-white">Login</Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="relative pt-16 pb-16 lg:pt-12 lg:pb-0">
            <div class="container mx-auto px-4 relative z-6">
                <div class="grid lg:grid-cols-2 gap-12 items-center">

                    <!-- Left Content -->
                    <div class="text-center lg:text-left">
                        <h1 
                            class="text-6xl md:text-6xl lg:text-6xl font-extrabold text-white leading-tight mb-0 min-h-[160px] md:min-h-[160px] lg:min-h-[140px]"
                            data-aos="fade-right"
                        >
                            <TextType 
                                :text="['Digitalisasi Pesantren\nTanpa Ribet', 'Kelola Pesantren\nJadi Mudah', 'Hemat Waktu\nHingga 80%']"
                                :typingSpeed="100"
                                :deletingSpeed="50"
                                :pauseDuration="2000"
                                :textColors="['#ffffff', '#F4D03F', '#ffffff']"
                                cursorCharacter="|"
                                cursorClassName="text-kun-gold"
                            />
                        </h1>
                        <BlurText
                            text="Kelola pendaftaran santri baru (PSB), seleksi, hingga pengumuman otomatis via WhatsApp. Hemat waktu panitia hingga 80%."
                            class="text-lg text-white/80 mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed"
                            :delay="150"
                            animateBy="words"
                            direction="top"
                        />
                        
                        <div 
                            class="flex flex-col sm:flex-row gap-2 justify-center lg:justify-start"
                            data-aos="fade-up"
                            data-aos-delay="400"
                        >
                            <a 
                                :href="pengaturan?.cta_link || '#'" 
                                target="_blank"
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-kun-primary font-bold rounded-full hover:bg-kun-gold hover:text-kun-primary transition-all duration-300 shadow-xl transform hover:-translate-y-1"
                            >
                                <!-- <Zap class="w-5 h-5" /> -->
                                {{ pengaturan?.cta_text || 'Coba Sekarang' }}
                            </a>
                            <a 
                                href="#features" 
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent border-2 border-white/30 text-white font-bold rounded-full hover:bg-white/10 transition-all duration-300"
                            >
                                Pelajari Fitur
                            </a>
                        </div>
                    </div>

                    <!-- Right Content (Image) -->
                    <div 
                        class="relative"
                        data-aos="fade-left"
                        data-aos-delay="600"
                    >
                        <div class="relative z-10 transform lg:translate-x-10">
                            <img src="/images/header_app.png" alt="App Preview" class="w-full max-w-md mx-auto lg:max-w-full drop-shadow-2xl" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <!-- Fallback Mockup if image missing -->
                            <div class="hidden bg-white rounded-3xl shadow-2xl p-2 max-w-sm mx-auto rotate-3 hover:rotate-0 transition-transform duration-500">
                                <div class="bg-slate-100 rounded-2xl overflow-hidden aspect-[9/19] relative border-4 border-slate-900">
                                    <div class="absolute top-0 inset-x-0 h-6 bg-slate-900 z-20 flex justify-center">
                                        <div class="w-20 h-4 bg-slate-900 rounded-b-xl"></div>
                                    </div>
                                    <div class="p-4 pt-12 space-y-4">
                                        <div class="h-8 w-24 bg-kun-primary/20 rounded-lg"></div>
                                        <div class="h-32 bg-white rounded-xl shadow-sm p-3">
                                            <div class="flex gap-3">
                                                <div class="w-10 h-10 bg-slate-200 rounded-full"></div>
                                                <div class="space-y-2 flex-1">
                                                    <div class="h-3 w-20 bg-slate-200 rounded"></div>
                                                    <div class="h-2 w-full bg-slate-100 rounded"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div class="h-24 bg-kun-primary text-white rounded-xl p-3 flex flex-col justify-between">
                                                <div class="w-8 h-8 bg-white/20 rounded-lg"></div>
                                                <div class="h-2 w-12 bg-white/40 rounded"></div>
                                            </div>
                                            <div class="h-24 bg-white rounded-xl shadow-sm p-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative Dots/Shapes behind image -->
                        <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-white/5 rounded-full blur-3xl"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white text-slate-800">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-bold text-slate-900 mb-4" data-aos="fade-up">Fitur Unggulan</h3>
                    <p class="text-slate-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                        Sistem manajemen modern yang dirancang khusus untuk kebutuhan pesantren.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="text-center p-6 rounded-2xl hover:shadow-xl transition-shadow duration-300 group" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-20 h-20 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-kun-primary transition-colors duration-300">
                            <LayoutDashboard class="w-10 h-10 text-kun-primary group-hover:text-white transition-colors duration-300" />
                        </div>
                        <h4 class="text-xl font-bold mb-3">Dashboard Interaktif</h4>
                        <p class="text-slate-600">Pantau data pendaftar, statistik, dan laporan keuangan dalam satu tampilan real-time.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center p-6 rounded-2xl hover:shadow-xl transition-shadow duration-300 group" data-aos="fade-up" data-aos-delay="400">
                        <div class="w-20 h-20 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-kun-primary transition-colors duration-300">
                            <MessageCircle class="w-10 h-10 text-kun-primary group-hover:text-white transition-colors duration-300" />
                        </div>
                        <h4 class="text-xl font-bold mb-3">WhatsApp Gateway</h4>
                        <p class="text-slate-600">Notifikasi otomatis ke wali santri untuk status pendaftaran dan pengumuman.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center p-6 rounded-2xl hover:shadow-xl transition-shadow duration-300 group" data-aos="fade-up" data-aos-delay="600">
                        <div class="w-20 h-20 mx-auto bg-red-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-kun-primary transition-colors duration-300">
                            <Database class="w-10 h-10 text-kun-primary group-hover:text-white transition-colors duration-300" />
                        </div>
                        <h4 class="text-xl font-bold mb-3">Cloud Database</h4>
                        <p class="text-slate-600">Data tersimpan aman di cloud, dapat diakses kapan saja dan dari mana saja.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="py-10 bg-gradient-to-br from-kun-primary to-[#D93030] overflow-hidden">
             <RollingGallery :images="pengaturan?.slider_images || []" :autoplay="true" :pause-on-hover="true" />
        </section>

        <!-- Solusi Section -->
        <section id="solusi" class="py-20 bg-slate-50 text-slate-800">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-right">
                        <img src="/images/about.png" alt="About" class="w-full max-w-lg mx-auto" onerror="this.style.display='none'">
                        <!-- Fallback -->
                        <div class="hidden bg-white p-6 rounded-2xl shadow-lg max-w-md mx-auto">
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 border-b pb-4">
                                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-bold">1</div>
                                    <div>
                                        <h4 class="font-bold">Daftar Online</h4>
                                        <p class="text-sm text-slate-500">Isi formulir dari rumah</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 border-b pb-4">
                                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-bold">2</div>
                                    <div>
                                        <h4 class="font-bold">Ujian Seleksi</h4>
                                        <p class="text-sm text-slate-500">Tes tulis & wawancara</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold">3</div>
                                    <div>
                                        <h4 class="font-bold">Pengumuman</h4>
                                        <p class="text-sm text-slate-500">Cek kelulusan via WA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div data-aos="fade-left">
                        <h3 class="text-3xl font-bold text-slate-900 mb-6">Solusi Digital Terpadu</h3>
                        <p class="text-slate-600 mb-6 leading-relaxed">
                            Tidak perlu lagi pusing dengan tumpukan berkas formulir. Sistem kami mendigitalkan seluruh proses penerimaan santri baru mulai dari pendaftaran hingga daftar ulang.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                <CheckCircle2 class="w-5 h-5 text-kun-primary" />
                                <span>Formulir pendaftaran customizable</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <CheckCircle2 class="w-5 h-5 text-kun-primary" />
                                <span>Cetak kartu ujian otomatis</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <CheckCircle2 class="w-5 h-5 text-kun-primary" />
                                <span>Laporan statistik pendaftar real-time</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <CheckCircle2 class="w-5 h-5 text-kun-primary" />
                                <span>Export data ke Excel/PDF</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="#" class="px-8 py-3 bg-kun-primary text-white font-bold rounded-full hover:bg-kun-light transition shadow-lg">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="pricing" class="py-20 bg-slate-50 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-kun-primary/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-white to-transparent"></div>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="text-center mb-16">
                    <span class="text-kun-primary font-bold tracking-wider uppercase text-sm mb-2 block" data-aos="fade-up">Penawaran Spesial</span>
                    <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4" data-aos="fade-up" data-aos-delay="100">Pilih Paket Terbaik</h3>
                    <p class="text-slate-600 max-w-2xl mx-auto text-lg" data-aos="fade-up" data-aos-delay="200">
                        Investasi terjangkau untuk transformasi digital pesantren Anda.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto items-center">
                    <div 
                        v-for="(pkg, index) in (packages || [])" 
                        :key="pkg.id"
                        class="relative group transition-all duration-300"
                        :class="[
                            pkg.is_populer 
                                ? 'bg-white rounded-3xl shadow-2xl scale-105 z-10 border-2 border-kun-primary' 
                                : 'bg-white rounded-2xl shadow-lg border border-slate-100 hover:shadow-xl hover:-translate-y-1'
                        ]"
                        data-aos="fade-up"
                        :data-aos-delay="index * 100"
                    >
                        <!-- Popular Badge -->
                        <div v-if="pkg.is_populer" class="absolute -top-5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-kun-primary to-kun-light text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg flex items-center gap-2">
                            <Star class="w-4 h-4 fill-white" />
                            Paling Laris
                        </div>

                        <div class="p-8 md:p-10">
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <h4 class="text-xl font-bold text-slate-900 mb-2">{{ pkg.nama_paket }}</h4>
                                <p class="text-slate-500 text-sm mb-6">{{ pkg.deskripsi }}</p>
                                
                                <div class="flex items-baseline justify-center gap-1">
                                    <span class="text-sm text-slate-500 font-medium">Rp</span>
                                    <span class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight">
                                        {{ (pkg.formatted_harga || '').replace('Rp ', '').split('/')[0] }}
                                    </span>
                                </div>
                                <div class="text-slate-500 text-sm mt-2 font-medium bg-slate-100 inline-block px-3 py-1 rounded-full">
                                    {{ pkg.periode }}
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="w-full h-px bg-slate-100 mb-8"></div>

                            <!-- Features -->
                            <ul class="space-y-4 mb-10">
                                <li 
                                    v-for="(fitur, idx) in pkg.fitur" 
                                    :key="idx" 
                                    class="flex items-start gap-3 text-sm text-slate-700"
                                >
                                    <div class="mt-0.5 w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                        <CheckCircle2 class="w-3.5 h-3.5 text-green-600" />
                                    </div>
                                    <span class="leading-tight">{{ fitur }}</span>
                                </li>
                            </ul>

                            <!-- CTA Button -->
                            <a 
                                :href="pkg.cta_link || '#'" 
                                target="_blank"
                                class="block w-full py-4 rounded-xl font-bold text-center transition-all duration-300 transform hover:-translate-y-1"
                                :class="[
                                    pkg.is_populer 
                                        ? 'bg-gradient-to-r from-kun-primary to-kun-light text-white shadow-lg hover:shadow-kun-primary/30' 
                                        : 'bg-slate-50 text-slate-900 hover:bg-slate-100 border border-slate-200'
                                ]"
                            >
                                {{ pkg.cta_text }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Section -->
        <section id="testimoni" class="py-20 bg-slate-50 text-slate-800">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-bold text-slate-900 mb-4" data-aos="fade-up">Apa Kata Mereka?</h3>
                    <p class="text-slate-600" data-aos="fade-up" data-aos-delay="100">Pengalaman pengguna sistem Pesantren Kita</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="(item, index) in (testimoni || []).filter(t => t.is_aktif)" 
                        :key="item.id"
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow"
                        data-aos="fade-up"
                        :data-aos-delay="index * 100"
                    >
                        <div class="flex gap-1 mb-4">
                            <Star v-for="n in 5" :key="n" class="w-4 h-4" :class="n <= item.rating ? 'text-yellow-400 fill-yellow-400' : 'text-gray-300'" />
                        </div>
                        <p class="text-slate-600 italic mb-6">"{{ item.konten }}"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-kun-primary/10 rounded-full flex items-center justify-center text-kun-primary font-bold">
                                {{ item.nama.charAt(0) }}
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-900">{{ item.nama }}</h5>
                                <p class="text-xs text-slate-500">{{ item.jabatan }} - {{ item.perusahaan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-slate-400 py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center gap-2 mb-4">
                            <img src="/images/logo.png" alt="Logo" class="h-16 w-auto rounded-lg shadow-lg bg-white p-1" />
                        </div>
                        <p class="text-sm max-w-xs">{{ pengaturan?.deskripsi || 'Platform digitalisasi manajemen pesantren terdepan di Indonesia.' }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-white font-bold mb-4">Menu</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#home" class="hover:text-white transition-colors">Home</a></li>
                            <li><a href="#features" class="hover:text-white transition-colors">Fitur</a></li>
                            <li><a href="#pricing" class="hover:text-white transition-colors">Harga</a></li>
                            <li><a href="#testimoni" class="hover:text-white transition-colors">Testimoni</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-bold mb-4">Kontak</h4>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-center gap-2"><Phone class="w-4 h-4" /> {{ pengaturan?.telepon || '-' }}</li>
                            <li class="flex items-center gap-2"><Mail class="w-4 h-4" /> {{ pengaturan?.email || '-' }}</li>
                            <li class="flex items-center gap-2"><Globe class="w-4 h-4" /> {{ pengaturan?.website || '-' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-8 text-center text-sm">
                    <p>&copy; {{ new Date().getFullYear() }} {{ pengaturan?.nama_lembaga || 'Pesantren Kita' }}. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top -->
        <a href="#home" class="fixed bottom-8 right-8 bg-kun-primary text-white p-3 rounded-full shadow-lg hover:bg-kun-light transition-colors z-50">
            <ArrowUp class="w-5 h-5" />
        </a>
    </div>
</template>

<style scoped>
/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}
</style>
