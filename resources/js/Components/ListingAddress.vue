<template>
    <span>
        <div>
            <span class="font-bold">{{ listing.beds }}</span> bds
            <span class="text-gray-400">| </span>
            <span class="font-bold">{{ listing.baths }}</span> ba
            <span class="text-gray-400">| </span>
            <span class="font-bold">{{ listing.area }}</span> m<sup>2</sup>
        </div>
        {{ listing.street }}
        {{ listing.street_nr }},
        {{ listing.city }}
    </span>
</template>

<script setup>
const probs = defineProps(["listing"]);
</script>
