<script setup>
import { Head } from '@inertiajs/vue3'
import SidebarLayout from '@/Layouts/Admin/SidebarLayout.vue'
import { Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { 
    MessageSquare,
    Save,
    ArrowLeft
} from 'lucide-vue-next'

const form = useForm({
    nama: '',
    jabatan: '',
    perusahaan: '',
    konten: '',
    rating: 5,
    is_aktif: true,
    foto: null,
})

const previewUrl = ref(null)

const handleFileChange = (event) => {
    const file = event.target.files[0]
    if (file) {
        if (previewUrl.value) {
            URL.revokeObjectURL(previewUrl.value)
        }
        form.foto = file
        previewUrl.value = URL.createObjectURL(file)
    } else {
        form.foto = null
        previewUrl.value = null
    }
}

const cleanupPreview = () => {
    if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value)
        previewUrl.value = null
    }
}

const submit = () => {
    const options = {
        onFinish: cleanupPreview,
    }

    if (form.foto) {
        options.forceFormData = true
    }

    form.post(route('admin.testimoni.store'), options)
}
</script>

<template>
    <Head title="Create Testimoni - Admin" />

    <SidebarLayout>
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <Link :href="route('admin.testimoni')" 
                                  class="text-gray-600 hover:text-gray-900">
                                <ArrowLeft class="w-5 h-5" />
                            </Link>
                            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                                <MessageSquare class="w-6 h-6" />
                                Create Testimoni
                            </h2>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama *
                                    </label>
                                    <input type="text" id="nama" v-model="form.nama" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">
                                        Jabatan *
                                    </label>
                                    <input type="text" id="jabatan" v-model="form.jabatan" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label for="perusahaan" class="block text-sm font-medium text-gray-700 mb-1">
                                    Perusahaan/Lembaga *
                                </label>
                                <input type="text" id="perusahaan" v-model="form.perusahaan" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="konten" class="block text-sm font-medium text-gray-700 mb-1">
                                    Testimoni *
                                </label>
                                <textarea id="konten" v-model="form.konten" rows="4" required
                                          placeholder="Tulis testimoni di sini..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">
                                    Rating *
                                </label>
                                <select id="rating" v-model.number="form.rating" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="5">★★★★★ (5 - Sangat Baik)</option>
                                    <option value="4">★★★★☆ (4 - Baik)</option>
                                    <option value="3">★★★☆☆ (3 - Cukup)</option>
                                    <option value="2">★★☆☆☆ (2 - Kurang)</option>
                                    <option value="1">★☆☆☆☆ (1 - Sangat Kurang)</option>
                                </select>
                            </div>

                            <div>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" v-model="form.is_aktif"
                                           class="rounded text-blue-600">
                                    <span class="text-sm text-gray-700">Aktif (tampilkan di landing page)</span>
                                </label>
                            </div>

                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">
                                    Foto Testimoni
                                </label>
                                <input
                                    id="foto"
                                    type="file"
                                    accept="image/*"
                                    @change="handleFileChange"
                                    class="w-full px-3 py-2 border border-dashed border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                />
                                <p class="text-xs text-gray-500 mt-1">Format jpg, png, atau webp (maks 2MB).</p>

                                <div v-if="previewUrl" class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Preview:</p>
                                    <img :src="previewUrl" alt="Preview Foto Testimoni" class="w-32 h-32 rounded-2xl object-cover border">
                                </div>
                            </div>

                            <div class="flex justify-end gap-4">
                                <Link :href="route('admin.testimoni')" 
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
