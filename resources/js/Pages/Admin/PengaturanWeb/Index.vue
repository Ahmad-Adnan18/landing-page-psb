<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import SidebarLayout from '@/Layouts/Admin/SidebarLayout.vue'
import { 
    Settings,
    Save,
    Globe,
    Phone,
    Mail,
    MapPin,

    ExternalLink,
    Image as ImageIcon,
    Trash2
} from 'lucide-vue-next'

const props = defineProps({
    pengaturan: Object,
})

const form = useForm({
    nama_lembaga: props.pengaturan?.nama_lembaga || '',
    deskripsi: props.pengaturan?.deskripsi || '',
    telepon: props.pengaturan?.telepon || '',
    email: props.pengaturan?.email || '',
    alamat_lengkap: props.pengaturan?.alamat_lengkap || '', // Changed from alamat to alamat_lengkap to match controller validation
    kota: props.pengaturan?.kota || '',
    provinsi: props.pengaturan?.provinsi || '',
    kode_pos: props.pengaturan?.kode_pos || '',
    website: props.pengaturan?.website || '',
    cta_text: props.pengaturan?.cta_text || '',
    cta_link: props.pengaturan?.cta_link || '',
    slogan: props.pengaturan?.slogan || '',
    slider_images: [],
    kept_slider_images: props.pengaturan?.slider_images || [],
})

const handleFileChange = (e) => {
    form.slider_images = Array.from(e.target.files)
}

const removeKeptImage = (index) => {
    form.kept_slider_images.splice(index, 1)
}

const submit = () => {
    form.transform((data) => ({
        ...data,
        _method: 'PUT',
    })).post(route('admin.pengaturan-web.update'), {
        preserveScroll: true,
        onSuccess: () => {
            // Optional: Show success notification
        },
    })
}
</script>

<template>
    <Head title="Pengaturan Web - Admin" />

    <SidebarLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <Settings class="w-6 h-6" />
                            <h2 class="text-2xl font-bold text-gray-900">Pengaturan Web</h2>
                        </div>

                        <form @submit.prevent="submit">
                            <div class="space-y-6">
                                <!-- General Settings -->
                                <div class="border-b pb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">General Settings</h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="nama_lembaga" class="block text-sm font-medium text-gray-700 mb-1">
                                                Nama Lembaga
                                            </label>
                                            <input type="text" id="nama_lembaga" v-model="form.nama_lembaga" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.nama_lembaga" class="text-red-500 text-xs mt-1">{{ form.errors.nama_lembaga }}</div>
                                        </div>

                                        <div>
                                            <label for="slogan" class="block text-sm font-medium text-gray-700 mb-1">
                                                Slogan
                                            </label>
                                            <input type="text" id="slogan" v-model="form.slogan" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.slogan" class="text-red-500 text-xs mt-1">{{ form.errors.slogan }}</div>
                                        </div>
                                        
                                        <div class="md:col-span-2">
                                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                                                Deskripsi
                                            </label>
                                            <textarea id="deskripsi" v-model="form.deskripsi" rows="3"
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                            <div v-if="form.errors.deskripsi" class="text-red-500 text-xs mt-1">{{ form.errors.deskripsi }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="border-b pb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-1">
                                                <Phone class="w-4 h-4" />
                                                Telepon
                                            </label>
                                            <input type="tel" id="telepon" v-model="form.telepon" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.telepon" class="text-red-500 text-xs mt-1">{{ form.errors.telepon }}</div>
                                        </div>
                                        
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-1">
                                                <Mail class="w-4 h-4" />
                                                Email
                                            </label>
                                            <input type="email" id="email" v-model="form.email" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</div>
                                        </div>
                                        
                                        <div class="md:col-span-2">
                                            <label for="alamat_lengkap" class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-1">
                                                <MapPin class="w-4 h-4" />
                                                Alamat Lengkap
                                            </label>
                                            <input type="text" id="alamat_lengkap" v-model="form.alamat_lengkap" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.alamat_lengkap" class="text-red-500 text-xs mt-1">{{ form.errors.alamat_lengkap }}</div>
                                        </div>
                                        
                                        <div>
                                            <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">
                                                Kota
                                            </label>
                                            <input type="text" id="kota" v-model="form.kota" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.kota" class="text-red-500 text-xs mt-1">{{ form.errors.kota }}</div>
                                        </div>
                                        
                                        <div>
                                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">
                                                Provinsi
                                            </label>
                                            <input type="text" id="provinsi" v-model="form.provinsi" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.provinsi" class="text-red-500 text-xs mt-1">{{ form.errors.provinsi }}</div>
                                        </div>

                                        <div>
                                            <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-1">
                                                Kode Pos
                                            </label>
                                            <input type="text" id="kode_pos" v-model="form.kode_pos" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.kode_pos" class="text-red-500 text-xs mt-1">{{ form.errors.kode_pos }}</div>
                                        </div>
                                        
                                        <div>
                                            <label for="website" class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-1">
                                                <Globe class="w-4 h-4" />
                                                Website
                                            </label>
                                            <input type="url" id="website" v-model="form.website" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.website" class="text-red-500 text-xs mt-1">{{ form.errors.website }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Call to Action -->
                                <div class="border-b pb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Call to Action</h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="cta_text" class="block text-sm font-medium text-gray-700 mb-1">
                                                CTA Text
                                            </label>
                                            <input type="text" id="cta_text" v-model="form.cta_text" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.cta_text" class="text-red-500 text-xs mt-1">{{ form.errors.cta_text }}</div>
                                        </div>
                                        
                                        <div>
                                            <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-1">
                                                <ExternalLink class="w-4 h-4" />
                                                CTA Link
                                            </label>
                                            <input type="url" id="cta_link" v-model="form.cta_link" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <div v-if="form.errors.cta_link" class="text-red-500 text-xs mt-1">{{ form.errors.cta_link }}</div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Slider Images -->
                                <div class="border-b pb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Slider Images</h3>
                                    
                                    <div class="space-y-4">
                                        <!-- Existing Images -->
                                        <div v-if="form.kept_slider_images.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            <div v-for="(image, index) in form.kept_slider_images" :key="index" class="relative group">
                                                <img :src="image" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                                                <button type="button" @click="removeKeptImage(index)" 
                                                        class="absolute top-2 right-2 p-1 bg-red-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <Trash2 class="w-4 h-4" />
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Upload New -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-1">
                                                <ImageIcon class="w-4 h-4" />
                                                Upload New Images
                                            </label>
                                            <input type="file" multiple accept="image/*" @change="handleFileChange"
                                                   class="block w-full text-sm text-slate-500
                                                          file:mr-4 file:py-2 file:px-4
                                                          file:rounded-full file:border-0
                                                          file:text-sm file:font-semibold
                                                          file:bg-blue-50 file:text-blue-700
                                                          hover:file:bg-blue-100">
                                            <p class="mt-1 text-xs text-gray-500">Supported formats: JPG, PNG, GIF. Max size: 2MB.</p>
                                            <div v-if="form.errors.slider_images" class="text-red-500 text-xs mt-1">{{ form.errors.slider_images }}</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div>
                                    <div class="flex justify-end">
                                        <button type="submit" 
                                                :disabled="form.processing"
                                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2 disabled:opacity-50">
                                            <Save class="w-4 h-4" />
                                            {{ form.processing ? 'Saving...' : 'Save Changes' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
