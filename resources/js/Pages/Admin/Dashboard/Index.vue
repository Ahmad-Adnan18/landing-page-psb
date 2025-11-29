<script setup>
import { Head } from '@inertiajs/vue3'
import SidebarLayout from '@/Layouts/Admin/SidebarLayout.vue'
import { Link } from '@inertiajs/vue3'
import { 
    Home, 
    Settings, 
    Users, 
    MessageSquare, 
    CreditCard,
    TrendingUp,
    Star,
    Activity,
    ArrowRight
} from 'lucide-vue-next'

const props = defineProps({
    stats: Object,
    recentTestimonis: Array,
    activePackages: Number,
})

const statCards = [
    {
        name: 'Pengaturan Web',
        icon: Settings,
        count: props.stats.pengaturan_web,
        color: 'bg-blue-500',
        textColor: 'text-blue-600',
        href: route('admin.pengaturan-web')
    },
    {
        name: 'Contact Person',
        icon: Users,
        count: props.stats.contact_persons,
        color: 'bg-green-500',
        textColor: 'text-green-600',
        href: route('admin.contact-persons')
    },
    {
        name: 'Testimoni',
        icon: MessageSquare,
        count: props.stats.testimonis,
        color: 'bg-yellow-500',
        textColor: 'text-yellow-600',
        href: route('admin.testimoni')
    },
    {
        name: 'Paket Harga',
        icon: CreditCard,
        count: props.stats.pricing_packages,
        color: 'bg-purple-500',
        textColor: 'text-purple-600',
        href: route('admin.pricing')
    },
]
</script>

<template>
    <Head title="Dashboard - Pesantren Kita" />

    <SidebarLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                    Dashboard Overview
                </h2>
                <div class="text-sm text-gray-600">
                    Selamat datang di Admin Dashboard Pesantren Kita
                </div>
            </div>
        </template>

        <div class="py-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div v-for="stat in statCards" :key="stat.name" class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div :class="stat.color" class="p-3 rounded-md">
                                    <component :is="stat.icon" class="h-6 w-6 text-white" />
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        {{ stat.name }}
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold" :class="stat.textColor">
                                            {{ stat.count }}
                                        </div>
                                        <div class="ml-2 text-sm text-gray-500">
                                            total
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <Link :href="stat.href" class="font-medium hover:underline flex items-center">
                                Kelola
                                <ArrowRight class="ml-1 w-4 h-4" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Testimoni -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow-sm rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Testimoni Terbaru
                                </h3>
                                <Link :href="route('admin.testimoni')" class="text-sm text-kun-primary hover:text-kun-light">
                                    Lihat Semua
                                </Link>
                            </div>
                            
                            <div class="space-y-4" v-if="recentTestimonis.length > 0">
                                <div v-for="testimoni in recentTestimonis" :key="testimoni.id" class="border-l-4 border-kun-primary pl-4 py-2">
                                    <div class="flex items-center justify-between mb-1">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ testimoni.nama_pemberi_testimoni }}</h4>
                                            <p class="text-sm text-gray-600">{{ testimoni.nama_pesantren }}</p>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <template v-for="i in 5" :key="i">
                                                <Star :class="i <= testimoni.rating ? 'text-yellow-400 fill-current' : 'text-gray-300'" class="w-4 h-4" />
                                            </template>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-700 line-clamp-2">{{ testimoni.isi_testimoni }}</p>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-xs text-gray-500">{{ testimoni.formatted_date }}</span>
                                        <span :class="testimoni.is_aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                                            {{ testimoni.is_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div v-else class="text-center py-8 text-gray-500">
                                <MessageSquare class="mx-auto h-12 w-12 text-gray-400" />
                                <p class="mt-2">Belum ada testimoni</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Info -->
                <div class="space-y-6">
                    Quick Actions
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            Aksi Cepat
                        </h3>
                        <div class="space-y-3">
                            <Link :href="route('admin.pengaturan-web')" class="block w-full text-center">
                                <button class="w-full bg-kun-primary text-white px-4 py-2 rounded-md hover:bg-kun-light transition-colors">
                                    Edit Pengaturan Web
                                </button>
                            </Link>
                            <Link :href="route('admin.testimoni')" class="block w-full text-center">
                                <button class="w-full bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50 transition-colors">
                                    Tambah Testimoni
                                </button>
                            </Link>
                            <Link :href="route('admin.pricing')" class="block w-full text-center">
                                <button class="w-full bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50 transition-colors">
                                    Kelola Harga
                                </button>
                            </Link>
                        </div>
                    </div>

                    <!-- Summary Info -->
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            Ringkasan
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between py-2 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Paket Aktif</span>
                                <span class="text-sm font-medium text-gray-900">{{ activePackages }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-200">
                                <span class="text-sm text-gray-600">Total Testimoni</span>
                                <span class="text-sm font-medium text-gray-900">{{ stats.testimonis }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600">Contact Person</span>
                                <span class="text-sm font-medium text-gray-900">{{ stats.contact_persons }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- System Info -->
                    <div class="bg-gradient-to-br from-kun-primary to-kun-light p-6 rounded-lg text-white">
                        <h3 class="text-lg leading-6 font-medium mb-2">
                            Sistem Pesantren Kita
                        </h3>
                        <p class="text-sm opacity-90 mb-4">
                            Dashboard Admin untuk mengelola konten website dan sistem informasi pesantren.
                        </p>
                        <div class="space-y-2 text-xs opacity-80">
                            <div>• Laravel 11</div>
                            <div>• Vue 3 + Inertia</div>
                            <div>• Tailwind CSS</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
