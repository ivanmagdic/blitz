<template>
    <AuthCard>
        <div class="text-center text-lg">
            Welcome {{ user.name }}!
        </div>

        <button v-on:click="logout"
                class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Logout
        </button>

    </AuthCard>
</template>

<script>
import Layout from "../Components/Layout";
import AuthCard from "../Components/AuthCard";

export default {
    components: {AuthCard},
    props: {
        user: Object
    },
    layout: Layout,
    methods: {
        logout() {
            this.$inertia.post(route('logout'))
        },
    }
}
</script>
