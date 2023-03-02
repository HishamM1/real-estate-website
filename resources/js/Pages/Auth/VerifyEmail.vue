<template>
    <div>
        You need to verify your email address. We have sent you an email with a
        link to verify your email address.
    </div>
    <div>
        <Link
            :href="route('verification.send')"
            method="POST"
            as="button"
            class="text-indigo-600"
            >Resend verification</Link
        >
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
