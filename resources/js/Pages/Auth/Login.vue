<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">E-mail (username)</label>
                <input
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="form-input"
                />
                <div class="text-red-500 text-sm mt-1" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="form-input"
                />
                <div
                    class="text-red-500 text-sm mt-1"
                    v-if="form.errors.password"
                >
                    {{ form.errors.password }}
                </div>
            </div>

            <div class="mt-4">
                <button
                    class="bg-blue-700 rounded-md p-1.5 text-white hover:bg-blue-900 w-full"
                    type="submit"
                    :disabled="form.processing"
                >
                    Login
                </button>
                <div class="mt-2 text-center">
                    <Link
                        :href="route('user.create')"
                        class="text-sm text-gray-500"
                    >
                        Don't have an account? Click here
                    </Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";
const form = useForm({
    email: null,
    password: null,
});
const login = () =>
    form.post(route("login.store"), {
        onError: () => form.reset("password"),
    });
</script>
