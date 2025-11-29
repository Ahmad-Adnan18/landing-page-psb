<script setup>
import { Head } from '@inertiajs/vue3'
import SidebarLayout from '@/Layouts/Admin/SidebarLayout.vue'
import { Link, useForm } from '@inertiajs/vue3'
import { 
    Users,
    Save,
    ArrowLeft,
    Edit2
} from 'lucide-vue-next'

const props = defineProps({
    contactPerson: Object,
})

const form = useForm({
    nama_lengkap: props.contactPerson.nama_lengkap,
    jabatan: props.contactPerson.jabatan,
    telepon: props.contactPerson.telepon,
    email: props.contactPerson.email,
    whatsapp: props.contactPerson.whatsapp,
    bio: props.contactPerson.bio,
    urutan: props.contactPerson.urutan,
    is_aktif: props.contactPerson.is_aktif,
})

const submit = () => {
    form.put(route('admin.contact-persons.update', props.contactPerson.id))
}
</script>

<template>
    <Head title="Edit Contact Person - Admin" />

    <SidebarLayout>
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <Link :href="route('admin.contact-persons')" 
                                  class="text-gray-600 hover:text-gray-900">
                                <ArrowLeft class="w-5 h-5" />
                            </Link>
                            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                                <Edit2 class="w-6 h-6" />
                                Edit Contact Person
                            </h2>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Lengkap *
                                    </label>
                                    <input type="text" id="nama_lengkap" v-model="form.nama_lengkap" required
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

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">
                                        Telepon *
                                    </label>
                                    <input type="tel" id="telepon" v-model="form.telepon" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                
                                <div>
                                    <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1">
                                        WhatsApp
                                    </label>
                                    <input type="tel" id="whatsapp" v-model="form.whatsapp"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email *
                                </label>
                                <input type="email" id="email" v-model="form.email" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">
                                    Bio / Deskripsi Singkat
                                </label>
                                <textarea id="bio" v-model="form.bio" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <div>
                                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">
                                    Urutan Tampil
                                </label>
                                <input type="number" id="urutan" v-model="form.urutan"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="flex justify-end gap-4">
                                <Link :href="route('admin.contact-persons')" 
                                      class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                                    Batal
                                </Link>
                                <button type="submit" 
                                        :disabled="form.processing"
                                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                                    <Save class="w-4 h-4" />
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
