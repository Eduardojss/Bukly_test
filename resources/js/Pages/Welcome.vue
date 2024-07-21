<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>

    <Head title="Welcome" />

    <div> <!-- Content container-->
        <nav class="bg-gray-800 p-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="#" class="text-white text-xl font-semibold">HOTELS</a>
                    </div>
                    <!-- Navbar links -->
                    <div v-if="this.$store.state.showLogin" class="hidden md:block">
                        <a href="/login"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="/register"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                    </div>
                    <div v-else class="hidden md:block">
                        <a href="/"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Hero Section -->
        <section class="bg-gray-800 text-white py-20">
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-semibold mb-6">Find Your Perfect Hotel</h1>
                <p class="text-lg mb-8">Compare prices from different websites and find the best deals.</p>
            </div>
        </section>

        <!-- Hotel Rooms Section -->
        <section class="container mx-auto my-12 px-4">

            <!-- Grid of Hotel Rooms -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                <!-- Hotel Room Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://via.placeholder.com/600x400" alt="Hotel Room 1" class="w-full h-64 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Luxury Suite</h2>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 font-semibold">$200/night</span>
                            <a href="#"
                                class="bg-gray-800 text-white px-4 py-2 rounded-full uppercase text-xs font-semibold hover:bg-gray-700 transition duration-300">Book
                                Now</a>
                        </div>
                    </div>
                </div>

                <!-- Hotel Room Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://via.placeholder.com/600x400" alt="Hotel Room 2" class="w-full h-64 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Standard Room</h2>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 font-semibold">$100/night</span>
                            <a href="#"
                                class="bg-gray-800 text-white px-4 py-2 rounded-full uppercase text-xs font-semibold hover:bg-gray-700 transition duration-300">Book
                                Now</a>
                        </div>
                    </div>
                </div>

                <!-- Hotel Room Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://via.placeholder.com/600x400" alt="Hotel Room 3" class="w-full h-64 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Family Suite</h2>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 font-semibold">$250/night</span>
                            <a href="#"
                                class="bg-gray-800 text-white px-4 py-2 rounded-full uppercase text-xs font-semibold hover:bg-gray-700 transition duration-300">Book
                                Now</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            page: 1,
            username: 'Eduardo',
        };
    },
    computed: {
    },
    created() {
    },
    methods: {
    },
};
</script>
