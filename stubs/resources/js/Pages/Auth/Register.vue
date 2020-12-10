<template>
    <AuthCard>
        <form @submit.prevent="submit">
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">
                    Name:
                </label>
                <input v-model="form.name" id="name" type="text" name="name" required
                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <div v-if="errors.name" class="text-red-700">{{ errors.name[0] }}</div>
            </div>

            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700">
                    Email:
                </label>
                <input v-model="form.email" id="email" type="email" name="email" required
                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <div v-if="errors.email" class="text-red-700">{{ errors.email[0] }}</div>
            </div>

            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">
                    Password:
                </label>

                <input v-model="form.password" id="password"
                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       type="password" name="password" required autocomplete="current-password"/>
            </div>

            <div class="mt-2">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">
                    Confirm Password:
                </label>

                <input v-model="form.password_confirmation" id="password_confirmation"
                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       type="password" name="password_confirmation" required autocomplete="current-password"/>
                <div v-if="errors.password" class="text-red-700">{{ errors.password[0] }}</div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Register
                </button>
            </div>

            <div class="mt-4 border-t-2 text-center">
                <div class="p-2">
                    Already have an account?
                    <inertia-link :href="route('login')" class="underline">
                        Login here.
                    </inertia-link>
                </div>
            </div>

        </form>
    </AuthCard>
</template>

<script>

import Layout from '../../Components/Layout'
import AuthCard from "../../Components/AuthCard";

export default {
    components: {
        AuthCard
    },
    layout: Layout,
    props: {
        errors: Object
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
        }
    },
    methods: {
        submit() {
            this.$inertia.post(route('register.submit'), this.form)
        },
    },
}
</script>
