<template>
    <div v-if="flash">
        {{ showFlash(flash) }}
    </div>
</template>

<script setup>
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const probs = defineProps(['type'])

const toast = useToast();
const flash = computed(() => usePage().props.flash)

const showFlash = (x) => {
    switch (probs.type) {
        case 'success':
            toast.success(x)
            break;
        case 'error':
            toast.error(x)
            break;
        default:
            toast.default(x)
    }
}
</script>
