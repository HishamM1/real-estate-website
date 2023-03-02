<template>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input
                    v-model.number="form.beds"
                    type="number"
                    class="form-input"
                />
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input
                    v-model.number="form.baths"
                    type="number"
                    class="form-input"
                />
                <div v-if="form.errors.beds" class="text-sm text-red-500">
                    {{ form.errors.beds }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Area</label>
                <input
                    v-model.number="form.area"
                    type="number"
                    class="form-input"
                />
                <div v-if="form.errors.area" class="text-sm text-red-500">
                    {{ form.errors.area }}
                </div>
            </div>
            <div class="col-span-4">
                <label class="label">City</label>
                <input v-model="form.city" type="text" class="form-input" />
                <div v-if="form.errors.city" class="text-sm text-red-500">
                    {{ form.errors.city }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input v-model="form.code" type="number" class="form-input" />
            </div>
            <div class="col-span-4">
                <label class="label">Street</label>
                <input v-model="form.street" type="text" class="form-input" />
                <div v-if="form.errors.street" class="text-sm text-red-500">
                    {{ form.errors.street }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Street Number</label>
                <input
                    v-model.number="form.street_nr"
                    type="number"
                    class="form-input"
                />
                <div v-if="form.errors.street_nr" class="text-sm text-red-500">
                    {{ form.errors.street_nr }}
                </div>
            </div>
            <div class="col-span-6">
                <label class="label">Price</label>
                <input
                    v-model.number="form.price"
                    type="number"
                    class="form-input"
                />
                <div v-if="form.errors.price" class="text-sm text-red-500">
                    {{ form.errors.price }}
                </div>
            </div>
            <div class="col-span-6">
                <button
                    type="submit"
                    class="bg-blue-700 rounded-md p-1.5 text-white hover:bg-blue-900"
                >
                    Update
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    listing: {
        type: Object,
    },
});
const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
});
const update = () =>
    form.put(route("realtor.listings.update", { listing: props.listing.id }));
</script>
