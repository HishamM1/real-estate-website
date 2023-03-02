<template>
    <div
        class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300"
    >
        <div class="text-gray-500 font-medium mb-1">
            <h1 class="text-2xl font-bold">Upload New Images</h1>
            <form @submit.prevent="upload">
                <section class="flex items-center gap-2 my-4">
                    <input
                        class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                        type="file"
                        multiple
                        @input="addFiles"
                    />
                    <button
                        type="submit"
                        class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                        :disabled="!canUpload"
                    >
                        Upload
                    </button>
                    <button type="reset" class="btn-outline" @click="reset">
                        Reset
                    </button>
                </section>
                <div v-if="imageErrors.length" class="text-red-500 text-sm">
                    <div v-for="(error, index) in imageErrors" :key="index">
                        {{ error }}.
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div
        v-if="listing.images.length"
        class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300 mt-4"
    >
        <div class="text-gray-500 font-medium mb-1">
            <h1 class="text-2xl font-bold">Current Listing Images</h1>
            <section class="mt-4 grid grid-cols-3 gap-4">
                <div
                    v-for="image in listing.images"
                    :key="image.id"
                    class="flex flex-col justify-between"
                >
                    <img :src="image.src" class="rounded-md" />
                    <Link
                        :href="
                            route('realtor.listing.image.destroy', {
                                listing: props.listing.id,
                                image: image.id,
                            })
                        "
                        method="delete"
                        as="button"
                        class="mt-2 btn-outline text-xs"
                    >
                        Delete
                    </Link>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps(["listing"]);

const form = useForm({
    images: [],
});
const upload = () => {
    form.post(
        route("realtor.listing.image.store", { listing: props.listing.id }),
        {
            onSuccess: () => form.reset("images"),
            onError: () => form.reset("images"),
        }
    );
};
const canUpload = computed(() => form.images.length);
const imageErrors = computed(() => Object.values(form.errors));

const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image);
    }
};
const reset = () => form.reset("images");
</script>
