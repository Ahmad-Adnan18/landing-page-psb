<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    active: Boolean,
    collapsed: Boolean
});

const isOpen = ref(props.active);

const toggle = () => {
    if (props.collapsed) return;
    isOpen.value = !isOpen.value;
};

// Watch for collapsed prop changes to close dropdown when sidebar collapses
// But we don't want to force it open when sidebar expands, only force close when it collapses
// However, the user's requirement implies hover behavior might control this too.
// Let's stick to simple toggle logic for now, controlled by parent if needed or self-managed.
</script>

<template>
    <div class="relative">
        <button
            @click="toggle"
            class="w-full flex items-center justify-between px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150"
            :class="[
                active ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
                collapsed ? 'justify-center' : ''
            ]"
        >
            <div class="flex items-center gap-3">
                <slot name="icon" />
                <span v-show="!collapsed" class="whitespace-nowrap transition-opacity duration-200">
                    {{ title }}
                </span>
            </div>
            <svg
                v-show="!collapsed"
                class="w-4 h-4 transition-transform duration-200"
                :class="{ 'rotate-180': isOpen }"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown Content -->
        <div
            v-show="isOpen && !collapsed"
            class="mt-1 space-y-1 pl-11 overflow-hidden transition-all duration-200"
        >
            <slot />
        </div>
    </div>
</template>
