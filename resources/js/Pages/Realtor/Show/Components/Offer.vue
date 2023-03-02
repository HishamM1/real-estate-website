<template>
    <div
        class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm flex md:col-span-7 items-center"
    >
        <div class="text-gray-500 font-medium mb-1 w-full">
            <h1>
                Offer #{{ offer.id }}
                <span
                    v-if="offer.accepted_at"
                    class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1"
                    >accepeted</span
                >
            </h1>

            <section class="flex items-center justify-between">
                <div>
                    <Price :price="offer.amount" class="text-xl" />

                    <div class="text-gray-500">
                        Difference <Price :price="difference" />
                    </div>

                    <div class="text-gray-500 text-sm">
                        Made by {{ offer.bidder.name }}
                    </div>

                    <div class="text-gray-500 text-sm">
                        Made on {{ madeOn }}
                    </div>
                </div>
                <div>
                    <Link
                        v-if="!isSold"
                        :href="
                            route('realtor.offer.accept', { offer: offer.id })
                        "
                        class="btn-outline text-xs font-medium"
                        as="button"
                        method="put"
                    >
                        Accept
                    </Link>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import Price from "@/Components/Price.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    isSold: Boolean,
});
const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());
</script>
