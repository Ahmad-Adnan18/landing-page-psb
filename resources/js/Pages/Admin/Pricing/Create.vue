<script setup>
import { Head } from '@inertiajs/vue3'
import SidebarLayout from '@/Layouts/Admin/SidebarLayout.vue'
import { Link, useForm } from '@inertiajs/vue3'
import { 
    Plus,
    Save,
    ArrowLeft,
    Trash2
} from 'lucide-vue-next'

const form = useForm({
    nama_paket: '',
    harga: '',
    harga_diskon: null,
    periode: '',
    deskripsi: '',
    fitur: [''],
    is_aktif: true,
    is_populer: false,
    cta_text: '',
    cta_link: '',
    urutan: 1,
})

const normalizeDiscount = () => {
    if (form.harga_diskon === '' || form.harga_diskon === undefined) {
        form.harga_diskon = null
    }
}

const submit = () => {
    normalizeDiscount()
    form.post(route('admin.pricing.store'))
}

const addFitur = () => {
    form.fitur.push('')
}

const removeFitur = (index) => {
    form.fitur.splice(index, 1)
}
</script>

<template>
    <Head title="Create Pricing Package - Admin" />

    <SidebarLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <Link :href="route('admin.pricing')" 
                                  class="text-gray-600 hover:text-gray-900">
                                <ArrowLeft class="w-5 h-5" />
                            </Link>
                            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                                <Plus class="w-6 h-6" />
                                Create Pricing Package
                            </h2>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_paket" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Paket *
                                    </label>
                                    <input type="text" id="nama_paket" v-model="form.nama_paket" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">
                                        Harga *
                                    </label>
                                    <input type="number" id="harga" v-model.number="form.harga" required min="0"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="harga_diskon" class="block text-sm font-medium text-gray-700 mb-1">
                                        Harga Diskon (opsional)
                                    </label>
                                    <input type="number" id="harga_diskon" v-model.number="form.harga_diskon" min="0"
                                           placeholder="Isi jika ingin menampilkan harga promo"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ada promo. Harga lama akan dicoret di landing page.</p>
                                </div>

                                <div>
                                    <label for="periode" class="block text-sm font-medium text-gray-700 mb-1">
                                        Periode *
                                    </label>
                                    <input type="text" id="periode" v-model="form.periode" required
                                           placeholder="per bulan, per tahun, dll"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">
                                        Urutan Tampil
                                    </label>
                                    <input type="number" id="urutan" v-model="form.urutan"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                                    Deskripsi *
                                </label>
                                <textarea id="deskripsi" v-model="form.deskripsi" rows="3" required
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Fitur-Fitur
                                </label>
                                <div v-for="(fitur, index) in form.fitur" :key="index" 
                                     class="flex gap-2 mb-2">
                                    <input type="text" v-model="form.fitur[index]"
                                           placeholder="Nama fitur"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <button type="button" @click="removeFitur(index)"
                                            class="text-red-600 hover:text-red-700">
                                        <Trash2 class="w-4 h-4" />
                                    </button>
                                </div>
                                <button type="button" @click="addFitur"
                                        class="text-blue-600 hover:text-blue-700 flex items-center gap-1">
                                    <Plus class="w-4 h-4" />
                                    Tambah Fitur
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="cta_text" class="block text-sm font-medium text-gray-700 mb-1">
                                        CTA Text
                                    </label>
                                    <input type="text" id="cta_text" v-model="form.cta_text"
                                           placeholder="Pilih Paket"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-1">
                                        CTA Link
                                    </label>
                                    <input type="url" id="cta_link" v-model="form.cta_link"
                                           placeholder="https://wa.me/..."
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" v-model="form.is_aktif"
                                           class="rounded text-blue-600">
                                    <span class="text-sm text-gray-700">Aktif</span>
                                </label>
                                
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" v-model="form.is_populer"
                                           class="rounded text-blue-600">
                                    <span class="text-sm text-gray-700">Paket Populer</span>
                                </label>
                            </div>

                            <div class="flex justify-end gap-4">
                                <Link :href="route('admin.pricing')" 
                                      class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                                    Batal
                                </Link>
                                <button type="submit" 
                                        :disabled="form.processing"
                                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                                    <Save class="w-4 h-4" />
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
