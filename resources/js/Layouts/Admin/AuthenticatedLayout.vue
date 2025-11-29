<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { Head } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { Menu, X, Home, Settings, Users, MessageSquare, CreditCard, LogOut, User } from 'lucide-vue-next'

const showingNavigationDropdown = ref(false)

const toggleNavigationDropdown = () => {
    showingNavigationDropdown.value = !showingNavigationDropdown.value
}

const closeNavigationDropdown = () => {
    showingNavigationDropdown.value = false
}

// Close dropdown when clicking outside
onMounted(() => {
    document.addEventListener('click', closeNavigationDropdown)
})

onUnmounted(() => {
    document.removeEventListener('click', closeNavigationDropdown)
})
</script>

<template>
    <div>
        <Head title="Admin Dashboard" />

        <div class="min-h-screen bg-gray-100">
            <!-- Navigation -->
            <nav class="bg-white shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <Link :href="route('dashboard')" class="flex items-center gap-2">
                                    <div class="h-8 w-8 bg-kun-primary rounded-lg flex items-center justify-center text-white font-bold text-sm">PK</div>
                                    <span class="font-bold text-xl text-gray-900">Pesantren<span class="text-kun-primary">Kita</span></span>
                                </Link>
                            </div>

                            <!-- Desktop Navigation -->
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                                <Link :href="route('admin.dashboard')" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-150">
                                    <Home class="w-4 h-4 mr-2" />
                                    Dashboard
                                </Link>
                                <Link :href="route('admin.pengaturan-web')" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-150">
                                    <Settings class="w-4 h-4 mr-2" />
                                    Pengaturan Web
                                </Link>
                                <Link :href="route('admin.contact-persons')" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-150">
                                    <Users class="w-4 h-4 mr-2" />
                                    Contact Person
                                </Link>
                                <Link :href="route('admin.testimoni')" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-150">
                                    <MessageSquare class="w-4 h-4 mr-2" />
                                    Testimoni
                                </Link>
                                <Link :href="route('admin.pricing')" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-150">
                                    <CreditCard class="w-4 h-4 mr-2" />
                                    Harga
                                </Link>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <!-- User Dropdown -->
                            <div class="ml-3 relative">
                                <button
                                    @click="toggleNavigationDropdown"
                                    class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-kun-primary"
                                >
                                    <div class="h-8 w-8 rounded-full bg-kun-primary flex items-center justify-center text-white font-bold">
                                        <User class="w-4 h-4" />
                                    </div>
                                </button>

                                <div
                                    :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                                    @click.stop
                                >
                                    <Link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Profile
                                    </Link>
                                    <Link
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    >
                                        <LogOut class="w-4 h-4 mr-2 inline" />
                                        Log Out
                                    </Link>
                                </div>
                            </div>

                            <!-- Mobile menu button -->
                            <div class="-mr-2 flex items-center sm:hidden">
                                <button
                                    @click="toggleNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-kun-primary"
                                >
                                    <Menu v-if="!showingNavigationDropdown" class="h-6 w-6" />
                                    <X v-else class="h-6 w-6" />
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Navigation -->
                    <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }" class="sm:hidden">
                        <div class="pt-2 pb-3 space-y-1">
                            <Link :href="route('admin.dashboard')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300">
                                <Home class="w-4 h-4 inline mr-2" />
                                Dashboard
                            </Link>
                            <Link :href="route('admin.pengaturan-web')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300">
                                <Settings class="w-4 h-4 inline mr-2" />
                                Pengaturan Web
                            </Link>
                            <Link :href="route('admin.contact-persons')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300">
                                <Users class="w-4 h-4 inline mr-2" />
                                Contact Person
                            </Link>
                            <Link :href="route('admin.testimoni')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300">
                                <MessageSquare class="w-4 h-4 inline mr-2" />
                                Testimoni
                            </Link>
                            <Link :href="route('admin.pricing')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300">
                                <CreditCard class="w-4 h-4 inline mr-2" />
                                Harga
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="py-6">
                        <slot name="header" />
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            <div v-if="$page.props.flash?.success" class="mb-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                        {{ $page.props.flash.success }}
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
