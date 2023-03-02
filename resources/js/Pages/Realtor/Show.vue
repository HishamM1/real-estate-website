<template>
    <div class="mb-4">
        <Link :href="route('realtor.listings.index')">
            ← Go back to Listings
        </Link>
    </div>
    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <div
            v-if="!hasOffers"
            class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm flex md:col-span-7 items-center"
        >
            <div class="text-gray-500 font-medium mb-1">
                <div class="w-full text-center font-medium text-gray-500">
                    No offers
                </div>
            </div>
        </div>
        <div v-else class="md:col-span-7 flex flex-col gap-4">
            <Offer
                v-for="offer in listing.offers"
                :key="offer.id"
                :offer="offer"
                :listing-price="listing.price"
                :is-sold="listing.sold_at != null"
            />
        </div>

        <div
            class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm flex md:col-span-7 items-center"
        >
            <div class="text-gray-500 font-medium mb-1">
                <h1>Basic Info</h1>
                <Price
                    :price="listing.price"
                    class="text-2xl font-bold text-gray-700"
                />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </div>
        </div>
    </section>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import Price from "@/Components/Price.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
import Offer from "./Show/Components/Offer.vue";

const props = defineProps({ listing: Object });
const hasOffers = computed(() => props.listing.offers.length);
</script>
