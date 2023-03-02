<template>
    <nav>
        <Link href="/home">Home</Link>
        <Link href="/menu">Menu</Link>
        <Link href="/logout" method="delete" as="button">Log out</Link>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<style lang="css">
.active {
    color: red;
}
</style>
