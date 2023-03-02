<template>
    <div class="grid grid-cols-12 gap-4">
        <div
            class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm col-span-7 flex items-center w-full"
        >
            <div v-if="listing.images.length" class="grid grid-cols-2 gap-1">
                <img
                    v-for="image in listing.images"
                    :key="image.id"
                    :src="image.src"
                    class="rounded-md"
                />
            </div>
            <div v-else class="w-full text-center font-medium text-gray-500">
                No images
            </div>
        </div>
        <div class="col-span-5 flex flex-col gap-4">
            <div
                class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm"
            >
                <div class="text-gray-500 font-medium">Basic info</div>
                <div>
                    <div class="font-bold text-2xl tracking-tighter">
                        <Price :price="listing.price"></Price>
                    </div>
                    <div></div>
                </div>
                <ListingAddress :listing="listing" />
            </div>
            <div
                class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm"
            >
                <div class="text-gray-500 font-medium mb-1">
                    Monthly Payment
                </div>
                <div>
                    <label class="label"
                        >Interest rate ({{ interestRate }}%)</label
                    >
                    <input
                        type="range"
                        min="0.1"
                        max="30"
                        step="0.1"
                        v-model.number="interestRate"
                        class="w-full h-4 bg-gray-200 rounded-lg appeara cursor-pointer"
                    />
                    <label class="label">Duration ({{ duration }} years)</label>
                    <input
                        type="range"
                        min="3"
                        max="35"
                        step="1"
                        v-model.number="duration"
                        class="w-full h-4 bg-gray-200 rounded-lg appeara cursor-pointer"
                    />

                    <div class="mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>
                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>
                                <div class="text-gray-400">Interest paid</div>

                                <Price
                                    :price="totalInterest"
                                    class="font-medium"
                                />
                            </div>
                            <div>
                                <div class="text-gray-400">Total paid</div>

                                <Price :price="totalPaid" class="font-medium" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <MakeOffer
                v-if="user && user.id !== listing.user_id && !offerMade"
                :listing-id="listing.id"
                :price="listing.price"
                @offer-updated="offer = $event"
            />
            <OfferMade v-else-if="user && offerMade" :offer="offerMade" />
        </div>
    </div>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import Price from "@/Components/Price.vue";
import { ref, computed } from "vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment.js";
import MakeOffer from "./Show/Components/MakeOffer.vue";
import { usePage } from "@inertiajs/vue3";
import OfferMade from "./Show/Components/OfferMade.vue";

const offer = ref(props.listing.price);
const interestRate = ref(2.5);
const duration = ref(25);
const props = defineProps({
    listing: {
        type: Object,
    },
    offerMade: {
        type: Object,
    },
});

const user = computed(() => usePage().props.user);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer,
    interestRate,
    duration
);
</script>
