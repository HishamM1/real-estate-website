<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input
                    type="number"
                    placeholder="Price from"
                    class="input-filter-l w-28"
                    v-model.number="form.priceFrom"
                />
                <input
                    type="number"
                    placeholder="Price to"
                    class="input-filter-r w-28"
                    v-model.number="form.priceTo"
                />
            </div>
            <div class="flex flex-nowrap items-center">
                <select class="input-filter-l w-28" v-model="form.beds">
                    <option :value="null">Beds</option>
                    <option v-for="n in 6" :key="n" :value="n">{{ n }}</option>
                </select>
                <select class="input-filter-r w-28" v-model="form.baths">
                    <option :value="null">Baths</option>

                    <option v-for="n in 6" :key="n" :value="n">{{ n }}</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input
                    type="number"
                    placeholder="Area from"
                    class="input-filter-l w-28"
                    v-model.number="form.areaFrom"
                />
                <input
                    type="number"
                    placeholder="Area to"
                    class="input-filter-r w-28"
                    v-model.number="form.areaTo"
                />
            </div>
            <button
                type="submit"
                class="bg-gray-600 hover:bg-gray-500 text-white font-medium p-2 rounded-md"
            >
                Filter
            </button>
            <button @click="clear">Clear</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    filters: Object,
});
const form = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
});

const filter = () => {
    form.transform((data) => {
        let nonEmptyData = {};
        for (const input in data) {
            if (data[input] !== null) {
                nonEmptyData[input] = data[input];
            }
        }
        return nonEmptyData;
    }).get(route("listings.index"), {
        preserveState: true,
        preserveScroll: true,
    });
};

const clear = () => {
    form.priceFrom = null;
    form.priceTo = null;
    form.beds = null;
    form.baths = null;
    form.areaFrom = null;
    form.areaTo = null;
    filter();
};
</script>
