<template>
    <div
        class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300"
    >
        <div class="text-gray-500 font-medium mb-1">
            <h1>Make an Offer</h1>

            <div>
                <form @submit.prevent="makeOffer">
                    <input
                        v-model.number="form.amount"
                        type="text"
                        class="form-input"
                    />
                    <input
                        v-model.number="form.amount"
                        type="range"
                        :min="min"
                        :max="max"
                        step="1000"
                        class="w-full h-4 bg-gray-200 rounded-lg appeara cursor-pointer"
                    />
                    <button
                        type="submit"
                        class="btn-outline w-full mt-2 text-sm"
                    >
                        Make an Offer
                    </button>
                    {{ form.errors.amount }}
                </form>
            </div>
            <div class="flex justify-between text-gray-500 mt-2">
                <div>Difference</div>
                <div>
                    <Price :price="difference" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Price from "@/Components/Price.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, watch } from "vue";
const props = defineProps({
    listingId: Number,
    price: Number,
});
const form = useForm({
    amount: props.price,
});

const makeOffer = () =>
    form.post(route("listing.offer.store", { listing: props.listingId }), {
        preserveScroll: true,
        preserveState: true,
    });
const difference = computed(() => form.amount - props.price);
const min = computed(() => Math.round(props.price / 2));
const max = computed(() => Math.round(props.price * 2));

const emit = defineEmits(["offerUpdated"]);

watch(
    () => form.amount,
    (val) => emit("offerUpdated", val)
);
</script>
