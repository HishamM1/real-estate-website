<template>
    <h1 class="font-bold text-3xl mb-4">Your Listings</h1>

    <RealtorFilter :filters="filters" />
    <section class="grid grid-cols lg:grid-cols-2 gap-2">
        <div
            class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm"
            :class="{ 'border-dashed': listing.deleted_at }"
            v-for="listing in listings.data"
            :key="listing.id"
        >
            <div class="text-gray-500 font-medium mb-1">
                <div
                    class="flex flex-col md:flex-row gap-2 md:items-center justify-between"
                >
                    <div :class="{ 'opacity-25': listing.deleted_at }">
                        <div
                            v-if="listing.sold_at != null"
                            class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2"
                        >
                            sold
                        </div>
                        <div class="xl:flex items-center gap-2">
                            <Price
                                :price="listing.price"
                                class="text-xl font-medium text-gray-700"
                            />
                        </div>
                        <ListingAddress :listing="listing" />
                    </div>
                    <section>
                        <div
                            class="flex items-center gap-1 text-gray-600 dark:text-gray-300"
                        >
                            <a
                                :href="
                                    route('listings.show', {
                                        listing: listing.id,
                                    })
                                "
                                class="btn-outline text-xs font-medium"
                                target="_blank"
                                >Preview</a
                            >
                            <Link
                                class="btn-outline text-xs font-medium"
                                :href="
                                    route('realtor.listings.edit', {
                                        listing: listing.id,
                                    })
                                "
                                >Edit</Link
                            >
                            <Link
                                v-if="!listing.deleted_at"
                                class="btn-outline text-xs font-medium"
                                :href="
                                    route('realtor.listings.destroy', {
                                        listing: listing.id,
                                    })
                                "
                                method="delete"
                                as="button"
                                :disabled="isDisabled"
                                @click="disableButton()"
                                >Delete</Link
                            >
                            <Link
                                v-else
                                class="btn-outline text-xs font-medium"
                                :href="
                                    route('realtor.listings.restore', {
                                        listing: listing.id,
                                    })
                                "
                                method="put"
                                as="button"
                                :disabled="isDisabled"
                                @click="disableButton()"
                                >Restore</Link
                            >
                        </div>
                        <div class="mt-2">
                            <Link
                                :href="
                                    route('realtor.listing.image.create', {
                                        listing: listing.id,
                                    })
                                "
                                class="block w-full btn-outline text-xs font-medium text-center"
                            >
                                Images ({{ listing.images_count }})
                            </Link>
                        </div>
                        <div class="mt-2">
                            <Link
                                :href="
                                    route('realtor.listings.show', {
                                        listing: listing.id,
                                    })
                                "
                                class="block w-full btn-outline text-xs font-medium text-center"
                            >
                                Offers ({{ listing.offers_count }})
                            </Link>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section
        v-if="listings.data.length"
        class="w-full flex justify-center mt-4 mb-4"
    >
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import Price from "@/Components/Price.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import RealtorFilter from "./Index/Components/RealtorFitlers.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps(["listings", "filters"]);

const isDisabled = ref(false);

const disableButton = () => {
    isDisabled.value = true;
    setTimeout(() => {
        isDisabled.value = false;
    }, 1000);
};
</script>
