<template>
    <div
        class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm"
    >
        <div class="text-gray-500 font-medium mb-1">
            <h1>Offer Made</h1>

            <Price :price="offer.amount" class="text-3xl" />

            <section
                class="mt-2 flex flex-col md:flex-row justify-between text-gray-500"
            >
                <div>Made on</div>
                <div class="font-medium">{{ offerMadeOn }}</div>
            </section>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import Price from "@/Components/Price.vue";
const props = defineProps({
    offer: Object,
});
const offerMadeOn = computed(() =>
    new Date(props.offer.created_at).toDateString()
);
</script>
