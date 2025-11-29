<script setup>
import { Head } from '@inertiajs/vue3'
import SidebarLayout from '@/Layouts/Admin/SidebarLayout.vue'
import { Link, router } from '@inertiajs/vue3'
import { 
    Star,
    Plus,
    Edit2,
    Trash2,
    ToggleLeft,
    ToggleRight,
    MessageSquare,
    User
} from 'lucide-vue-next'

const props = defineProps({
    testimoni: Array,
})

const toggleTestimoni = (item) => {
    if (confirm(`Apakah Anda yakin ingin ${item.is_aktif ? 'menonaktifkan' : 'mengaktifkan'} testimoni dari ${item.nama}?`)) {
        router.patch(route('admin.testimoni.toggle', item.id), {
            is_aktif: !item.is_aktif
        })
    }
}

const deleteTestimoni = (item) => {
    if (confirm(`Apakah Anda yakin ingin menghapus testimoni dari ${item.nama}? Tindakan ini tidak dapat dibatalkan.`)) {
        router.delete(route('admin.testimoni.destroy', item.id))
    }
}

const renderStars = (rating) => {
    let stars = ''
    for (let i = 1; i <= 5; i++) {
        stars += i <= rating ? '★' : '☆'
    }
    return stars
}
</script>

<template>
    <Head title="Testimoni - Admin" />

    <SidebarLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                                <MessageSquare class="w-6 h-6" />
                                Testimoni
                            </h2>
                            <Link :href="route('admin.testimoni.create')" 
                                  class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                                <Plus class="w-4 h-4" />
                                Add Testimoni
                            </Link>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div v-for="item in (testimoni || [])" :key="item.id" 
                                 class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900">{{ item.nama }}</h3>
                                        <p class="text-sm text-gray-600">{{ item.jabatan }}</p>
                                        <p class="text-sm text-gray-500">{{ item.perusahaan }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button @click="toggleTestimoni(item)"
                                                :class="item.is_aktif ? 'text-green-600' : 'text-gray-400'"
                                                class="hover:opacity-75">
                                            <component :is="item.is_aktif ? ToggleRight : ToggleLeft" class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-1 mb-3">
                                    <span class="text-yellow-400">{{ renderStars(item.rating) }}</span>
                                    <span class="text-sm text-gray-600">({{ item.rating }}/5)</span>
                                </div>
                                
                                <p class="text-gray-700 text-sm mb-4">"{{ item.konten }}"</p>
                                
                                <div class="flex gap-2">
                                    <Link :href="route('admin.testimoni.edit', item)" 
                                          class="text-blue-600 hover:text-blue-700 flex items-center gap-1">
                                        <Edit2 class="w-3 h-3" />
                                        Edit
                                    </Link>
                                    <button @click="deleteTestimoni(item)" 
                                            class="text-red-600 hover:text-red-700 flex items-center gap-1">
                                        <Trash2 class="w-3 h-3" />
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div v-if="!testimoni || !testimoni.length" class="text-center py-12">
                            <MessageSquare class="w-12 h-12 text-gray-400 mx-auto mb-4" />
                            <p class="text-gray-600">No testimoni found</p>
                            <p class="text-sm text-gray-500">Start by adding your first testimoni.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
