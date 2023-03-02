<template>
    <div
        class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300"
    >
        <Link :href="route('listings.show', { listing: listing.id })">
            <div class="flex items-center gap-1">
                <div class="font-bold text-2xl tracking-tighter">
                    <Price :price="listing.price"></Price>
                </div>
                <div class="text-xs text-gray-500">
                    <Price :price="monthlyPayment" /> pm
                </div>
            </div>
            <ListingAddress :listing="listing" />
        </Link>

        <!-- <div>
            <Link :href="route('listings.edit', { listing: listing.id })"
                >Edit</Link
            >
        </div> -->
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import Price from "@/Components/Price.vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment.js";

const props = defineProps(["listing"]);
const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>
