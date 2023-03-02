<template>
    <div class="flex justify-between items-center px-28 py-4 mb-1 border-b">
        <div class="text-xl font-bold text-blue-600">
            <Link :href="route('listings.index')">LaraZillow</Link>
        </div>

        <Link :href="route('realtor.listings.index')" v-if="user"
            >Hello, {{ user.name }}!</Link
        >
        <div class="flex items-center gap-4">
            <Link
                :href="route('listings.index')"
                class="font-medium hover:text-blue-700"
            >
                Listings
            </Link>
            <Link
                :href="route('notifications.index')"
                class="text-gray-500 relative pr-2 py-2 text-lg"
                v-if="user"
            >
                🔔
                <div
                    v-if="notificationCount"
                    class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center"
                >
                    {{ notificationCount }}
                </div>
            </Link>
            <Link
                v-if="user"
                :href="route('realtor.listings.create')"
                class="bg-blue-700 rounded-md p-1.5 text-white hover:bg-blue-900"
            >
                + New Listing
            </Link>

            <Link
                v-if="user"
                :href="route('logout')"
                method="delete"
                as="button"
                >Logout</Link
            >
            <Link v-if="!user" :href="route('user.create')">Register</Link>

            <Link v-if="!user" :href="route('login')">Sign-In</Link>
        </div>
    </div>

    <main class="container p-4 mx-auto w-full">
        <FlashMessage type="success" />
        <slot> Default </slot>
    </main>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import FlashMessage from "../Components/FlashMessage.vue";
const user = computed(() => usePage().props.user);
const notificationCount = computed(
    () => usePage().props.user.notificationCount
);
</script>
