<template>
    <h1 class="text-3xl mb-4">Your Notifications</h1>
    <Link
        :href="route('notification.seen.all')"
        v-if="notifications"
        as="button"
        method="put"
        class="btn-outline text-xs font-medium uppercase disabled:opacity-50 disabled:cursor-not-allowed"
        :disabled="!readNotification"
    >
        Mark ALL as read
    </Link>

    <section
        v-if="notifications.data.length"
        class="text-gray-700 dark:text-gray-400"
    >
        <div
            v-for="notification in notifications.data"
            :key="notification.id"
            class="border-b border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center"
        >
            <div>
                <span
                    v-if="notification.type === 'App\\Notifications\\OfferMade'"
                >
                    Offer <Price :price="notification.data.amount" /> for
                    <Link
                        :href="
                            route('realtor.listings.show', {
                                listing: notification.data.listing_id,
                            })
                        "
                        class="text-indigo-600 dark:text-indigo-400"
                        >listing</Link
                    >
                    was made
                </span>
            </div>
            <div>
                <Link
                    :href="
                        route('notification.seen', {
                            notification: notification.id,
                        })
                    "
                    v-if="!notification.read_at"
                    as="button"
                    method="put"
                    class="btn-outline text-xs font-medium uppercase"
                >
                    Mark as read
                </Link>
            </div>
        </div>
    </section>

    <div v-else>No notifications yet!</div>

    <section
        v-if="notifications.data.length"
        class="w-full flex justify-center mt-8 mb-8"
    >
        <Pagination :links="notifications.links" />
    </section>
</template>

<script setup>
import Price from "@/Components/Price.vue";
import Pagination from "@/Components/Pagination.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
    notifications: Object,
});

const readNotification = computed(() => {
    return props.notifications.data.filter((notification) => {
        return !notification.read_at;
    }).length;
});
console.log(readNotification.value);
</script>
