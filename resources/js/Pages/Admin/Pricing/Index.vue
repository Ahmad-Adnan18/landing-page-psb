<script setup>
import { Head } from '@inertiajs/vue3'
import SidebarLayout from '@/Layouts/Admin/SidebarLayout.vue'
import { Link, router } from '@inertiajs/vue3'
import { 
    CreditCard,
    Plus,
    Edit2,
    Trash2,
    ToggleLeft,
    ToggleRight,
    Star,
    TrendingUp
} from 'lucide-vue-next'

const props = defineProps({
    packages: Array,
})

const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(price)
}

const hasDiscount = (pkg) => {
    if (pkg.harga_diskon === null || pkg.harga_diskon === undefined) {
        return false
    }

    const hargaDiskon = Number(pkg.harga_diskon)
    const hargaNormal = Number(pkg.harga)

    if (Number.isNaN(hargaDiskon) || hargaDiskon <= 0) {
        return false
    }

    if (!Number.isNaN(hargaNormal) && hargaNormal > 0) {
        return hargaDiskon < hargaNormal
    }

    return true
}

const togglePackage = (pkg) => {
    if (confirm(`Apakah Anda yakin ingin ${pkg.is_aktif ? 'menonaktifkan' : 'mengaktifkan'} paket ${pkg.nama_paket}?`)) {
        router.patch(route('admin.pricing.toggle', pkg.id), {
            is_aktif: !pkg.is_aktif
        })
    }
}

const togglePopular = (pkg) => {
    if (confirm(`Apakah Anda yakin ingin ${pkg.is_populer ? 'menghapus status populer dari' : 'menandai sebagai populer'} paket ${pkg.nama_paket}?`)) {
        router.patch(route('admin.pricing.toggle-popular', pkg.id), {
            is_populer: !pkg.is_populer
        })
    }
}

const deletePackage = (pkg) => {
    if (confirm(`Apakah Anda yakin ingin menghapus paket ${pkg.nama_paket}? Tindakan ini tidak dapat dibatalkan.`)) {
        router.delete(route('admin.pricing.destroy', pkg.id))
    }
}
</script>

<template>
    <Head title="Pricing Packages - Admin" />

    <SidebarLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                                <CreditCard class="w-6 h-6" />
                                Pricing Packages
                            </h2>
                            <Link :href="route('admin.pricing.create')" 
                                  class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                                <Plus class="w-4 h-4" />
                                Add Package
                            </Link>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div v-for="pkg in packages" :key="pkg.id" 
                                 class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-bold text-gray-900">{{ pkg.nama_paket }}</h3>
                                    <div class="flex items-center gap-2">
                                        <button @click="togglePopular(pkg)" 
                                                class="text-yellow-500 hover:text-yellow-600">
                                            <Star :class="pkg.is_populer ? 'fill-current' : ''" class="w-4 h-4" />
                                        </button>
                                        <button @click="togglePackage(pkg)"
                                                :class="pkg.is_aktif ? 'text-green-600' : 'text-gray-400'"
                                                class="ml-2 hover:opacity-75">
                                            <component :is="pkg.is_aktif ? ToggleRight : ToggleLeft" class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mb-4 space-y-1">
                                    <div v-if="hasDiscount(pkg)" class="space-y-1">
                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-white bg-rose-500/90 px-2 py-0.5 rounded-full">
                                            <TrendingUp class="w-3 h-3" />
                                            Promo
                                        </span>
                                        <div class="text-sm text-gray-400 line-through">{{ formatPrice(pkg.harga) }}</div>
                                        <div class="text-2xl font-bold text-blue-600">{{ formatPrice(pkg.harga_diskon) }}</div>
                                    </div>
                                    <div v-else class="text-2xl font-bold text-blue-600">{{ formatPrice(pkg.harga) }}</div>
                                    <div class="text-sm text-gray-500">{{ pkg.periode }}</div>
                                </div>
                                
                                <p class="text-gray-600 text-sm mb-4">{{ pkg.deskripsi }}</p>
                                
                                <div class="mb-4">
                                    <h4 class="font-medium text-gray-900 mb-2">Features:</h4>
                                    <ul class="text-sm text-gray-600 space-y-1">
                                        <li v-for="fitur in pkg.fitur" :key="fitur" class="flex items-center gap-1">
                                            <span class="w-1 h-1 bg-green-500 rounded-full"></span>
                                            {{ fitur }}
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="flex gap-2">
                                    <Link :href="route('admin.pricing.edit', pkg)" 
                                          class="text-blue-600 hover:text-blue-700 flex items-center gap-1">
                                        <Edit2 class="w-3 h-3" />
                                        Edit
                                    </Link>
                                    <button @click="deletePackage(pkg)" 
                                            class="text-red-600 hover:text-red-700 flex items-center gap-1">
                                        <Trash2 class="w-3 h-3" />
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
