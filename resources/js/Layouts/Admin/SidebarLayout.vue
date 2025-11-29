<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SidebarDropdown from '@/Components/SidebarDropdown.vue';
import { 
    LayoutDashboard, 
    MessageSquare, 
    CreditCard, 
    Users, 
    Settings,
    LogOut,
    Menu,
    X
} from 'lucide-vue-next';

const sidebarOpen = ref(false);
const isHovered = ref(false);
const user = usePage().props.auth.user;

// Function to handle logout
const logout = () => {
    // Inertia handles this via Link method="post"
};
</script>

<template>
    <div class="h-screen overflow-hidden bg-gray-50 flex flex-col lg:flex-row">
        <!-- Sidebar -->
        <div
            class="fixed inset-y-0 left-0 z-40 bg-white border-r border-gray-100 transform transition-all duration-300 ease-in-out lg:relative lg:translate-x-0"
            :class="[
                { '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen },
                isHovered ? 'lg:w-64' : 'lg:w-20',
                'w-64' // Mobile width is always 64
            ]"
            @mouseenter="isHovered = true"
            @mouseleave="isHovered = false"
        >
            <div class="flex h-full flex-col overflow-hidden">
                <!-- Logo -->
                <div class="flex items-center h-20 px-4 shrink-0 transition-all duration-300" :class="isHovered ? 'justify-start' : 'justify-center'">
                    <Link :href="route('admin.dashboard')" class="flex items-center gap-2">
                        <div class="h-10 w-10 bg-gradient-to-br from-kun-primary to-kun-light rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg shrink-0">
                            PK
                        </div>
                        <span v-show="isHovered" class="text-red-700 font-bold text-lg whitespace-nowrap transition-opacity duration-200">Kun Karima</span>
                    </Link>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto overflow-x-hidden">
                    <!-- Menu Utama -->
                    <div class="space-y-1">
                        <h3 class="px-3 text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 transition-opacity duration-200" :class="{ 'opacity-0': !isHovered }">Menu</h3>

                        <!-- Dashboard -->
                        <Link
                            :href="route('admin.dashboard')"
                            class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150"
                            :class="[
                                route().current('admin.dashboard') ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
                                !isHovered ? 'justify-center' : ''
                            ]"
                        >
                            <LayoutDashboard class="h-5 w-5 flex-shrink-0" />
                            <span v-show="isHovered" class="whitespace-nowrap transition-opacity duration-200">Dashboard</span>
                        </Link>

                        <!-- Testimoni -->
                        <Link
                            :href="route('admin.testimoni')"
                            class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150"
                            :class="[
                                route().current('admin.testimoni*') ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
                                !isHovered ? 'justify-center' : ''
                            ]"
                        >
                            <MessageSquare class="h-5 w-5 flex-shrink-0" />
                            <span v-show="isHovered" class="whitespace-nowrap transition-opacity duration-200">Testimoni</span>
                        </Link>

                        <!-- Paket Harga -->
                        <Link
                            :href="route('admin.pricing')"
                            class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150"
                            :class="[
                                route().current('admin.pricing*') ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
                                !isHovered ? 'justify-center' : ''
                            ]"
                        >
                            <CreditCard class="h-5 w-5 flex-shrink-0" />
                            <span v-show="isHovered" class="whitespace-nowrap transition-opacity duration-200">Paket Harga</span>
                        </Link>
                    </div>

                    <!-- Akun & Pengaturan -->
                    <div class="space-y-1 pt-4">
                        <h3 class="px-3 text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 transition-opacity duration-200" :class="{ 'opacity-0': !isHovered }">Sistem</h3>

                        <SidebarDropdown title="Pengaturan" :active="route().current('admin.pengaturan-web') || route().current('admin.contact-persons*')" :collapsed="!isHovered">
                            <template #icon>
                                <Settings class="h-5 w-5 flex-shrink-0" />
                            </template>

                            <Link :href="route('admin.pengaturan-web')" class="block px-3 py-2 rounded-md text-sm font-medium" :class="route().current('admin.pengaturan-web') ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'">
                                Pengaturan Web
                            </Link>
                            <Link :href="route('admin.contact-persons')" class="block px-3 py-2 rounded-md text-sm font-medium" :class="route().current('admin.contact-persons*') ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'">
                                Contact Persons
                            </Link>
                        </SidebarDropdown>
                    </div>
                </nav>

                <!-- User Profile -->
                <div class="p-4 border-t border-gray-100">
                    <div class="flex items-center" :class="isHovered ? '' : 'justify-center'">
                        <img class="h-9 w-9 rounded-full object-cover" :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=991B1B&color=fff`" alt="Avatar">
                        <div class="ml-3 transition-opacity duration-200" v-show="isHovered">
                            <p class="text-sm font-medium text-gray-900 whitespace-nowrap">{{ user.name }}</p>
                            <p class="text-xs text-gray-500 whitespace-nowrap">{{ user.email }}</p>
                        </div>
                        <Link v-show="isHovered" :href="route('logout')" method="post" as="button" class="ml-auto text-gray-400 hover:text-red-600 p-1 rounded-full hover:bg-gray-100 transition-colors">
                            <LogOut class="w-5 h-5" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content & Mobile Header -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header Mobile -->
            <header class="bg-white/90 backdrop-blur-sm sticky top-0 z-10 lg:hidden border-b border-gray-100">
                <div class="px-4">
                    <div class="flex items-center justify-between h-14">
                        <div class="flex items-center gap-2">
                            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700">
                                <Menu v-if="!sidebarOpen" class="h-6 w-6" />
                                <X v-else class="h-6 w-6" />
                            </button>
                            <Link :href="route('admin.dashboard')" class="flex items-center gap-2">
                                <span class="text-red-700 font-bold text-lg">Kun Karima</span>
                            </Link>
                        </div>
                        <img class="h-8 w-8 rounded-full" :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=991B1B&color=fff`" alt="Avatar">
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 bg-gray-50 pb-16 lg:pb-4">
                <slot />
            </main>

            <!-- Bottom Navigation Bar (Mobile) -->
            <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 lg:hidden">
                <div class="grid grid-cols-4 gap-1">
                    <Link :href="route('admin.dashboard')" class="flex flex-col items-center justify-center py-2 text-xs" :class="route().current('admin.dashboard') ? 'text-red-700' : 'text-gray-500'">
                        <LayoutDashboard class="w-6 h-6 mb-1" />
                        <span>Dashboard</span>
                    </Link>

                    <Link :href="route('admin.testimoni')" class="flex flex-col items-center justify-center py-2 text-xs" :class="route().current('admin.testimoni*') ? 'text-red-700' : 'text-gray-500'">
                        <MessageSquare class="w-6 h-6 mb-1" />
                        <span>Testimoni</span>
                    </Link>

                    <Link :href="route('admin.pricing')" class="flex flex-col items-center justify-center py-2 text-xs" :class="route().current('admin.pricing*') ? 'text-red-700' : 'text-gray-500'">
                        <CreditCard class="w-6 h-6 mb-1" />
                        <span>Harga</span>
                    </Link>

                    <Link :href="route('admin.pengaturan-web')" class="flex flex-col items-center justify-center py-2 text-xs" :class="route().current('admin.pengaturan-web') ? 'text-red-700' : 'text-gray-500'">
                        <Settings class="w-6 h-6 mb-1" />
                        <span>Setting</span>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
