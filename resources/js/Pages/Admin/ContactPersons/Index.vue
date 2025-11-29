<script setup>
import { Head } from '@inertiajs/vue3'
import SidebarLayout from '@/Layouts/Admin/SidebarLayout.vue'
import { Link } from '@inertiajs/vue3'
import { 
    Users,
    Plus,
    Edit2,
    Trash2,
    ToggleLeft,
    ToggleRight,
    Phone,
    Mail,
    MessageSquare
} from 'lucide-vue-next'

const props = defineProps({
    contactPersons: Array,
})

const toggleContactPerson = (person) => {
    // Implementation for toggling contact person
}
</script>

<template>
    <Head title="Contact Persons - Admin" />

    <SidebarLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                                <Users class="w-6 h-6" />
                                Contact Persons
                            </h2>
                            <Link :href="route('admin.contact-persons.create')" 
                                  class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
                                <Plus class="w-4 h-4" />
                                Add Contact Person
                            </Link>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div v-for="person in contactPersons" :key="person.id" 
                                 class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900">{{ person.nama_lengkap }}</h3>
                                        <p class="text-sm text-gray-600">{{ person.jabatan }}</p>
                                    </div>
                                    <button @click="toggleContactPerson(person)"
                                            :class="person.is_aktif ? 'text-green-600' : 'text-gray-400'"
                                            class="hover:opacity-75">
                                        <component :is="person.is_aktif ? ToggleRight : ToggleLeft" class="w-5 h-5" />
                                    </button>
                                </div>
                                
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <Phone class="w-4 h-4" />
                                        <span>{{ person.telepon }}</span>
                                    </div>
                                    <div v-if="person.whatsapp" class="flex items-center gap-2 text-sm text-gray-700">
                                        <MessageSquare class="w-4 h-4" />
                                        <span>{{ person.whatsapp }}</span>
                                    </div>
                                    <div v-if="person.email" class="flex items-center gap-2 text-sm text-gray-700">
                                        <Mail class="w-4 h-4" />
                                        <span>{{ person.email }}</span>
                                    </div>
                                </div>
                                
                                <div class="flex gap-2 mt-4">
                                    <Link :href="route('admin.contact-persons.edit', person)" 
                                          class="text-blue-600 hover:text-blue-700 flex items-center gap-1">
                                        <Edit2 class="w-3 h-3" />
                                        Edit
                                    </Link>
                                    <button @click="deleteContactPerson(person)" 
                                            class="text-red-600 hover:text-red-700 flex items-center gap-1">
                                        <Trash2 class="w-3 h-3" />
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div v-if="!contactPersons.length" class="text-center py-12">
                            <Users class="w-12 h-12 text-gray-400 mx-auto mb-4" />
                            <p class="text-gray-600">No contact persons found</p>
                            <p class="text-sm text-gray-500">Start by adding your first contact person.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
