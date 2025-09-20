<template>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top bg-white py-0 shadow-sm">
        <div class="container">
            <!-- Logo and Brand Name -->
            <Link class="navbar-brand" href="/">
            <img src="../assets/imgs/quickbiteLogo_noBG.png" alt="Logo" class="h-50" />QuickBite</Link>

            <!-- Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="navbar-collapse justify-content-end collapse" id="navbarNav">
                <ul class="navbar-nav mb-lg-0 mb-3">
                    <li class="nav-item">
                        <Link :href="route('home')" class="nav-link" :class="{ active: route().current('home') }">Home
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('menus')" class="nav-link" :class="{ active: route().current('menus') }">
                        Menus</Link>
                    </li>
                    <!-- <li class="nav-item">
              <Link :href="route('offers')" class="nav-link" :class="{ active: route().current('offers') }">Offers</Link>
            </li> -->
                    <li class="nav-item">
                        <Link :href="route('restaurants.index')" class="nav-link"
                            :class="{ active: route().current('restaurants.index') }">Restaurants</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('tracking')" class="nav-link"
                            :class="{ active: route().current('tracking') }">Track your Order</Link>
                    </li>
                </ul>

                <!-- Login/Signup or Dashboard/Logout Buttons -->
                <div v-if="user" class="d-flex align-items-center ms-lg-3">
                        <li class="nav-item dropdown" v-if="user.role === 'restaurant'">
                        <Link :href="route('dashboard')" class="nav-link dropdown-toggle login-signup-btn" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        {{ user.name }}</Link>
                        <ul class="dropdown-menu">
                            <li>
                                <Link :href="route('restaurant.dashboard')" class="dropdown-item me-2">Dashboard</Link>
                            </li>
                            <li>
                                <Link :href="route('logout')" method="post" as="button" class="dropdown-item">Logout
                                </Link>
                            </li>
                        </ul>
                    </li>
                        
                        
                    <!-- <Link v-else :href="route('products.index')" class="login-signup-btn me-2">Products</Link> -->

                    
                    <li class="nav-item dropdown" v-else-if="user.role === 'customer'">
                        <Link :href="route('dashboard')" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        {{ user.name }}</Link>
                        <ul class="dropdown-menu">
                            <li>
                                <Link :href="route('dashboard')" class="dropdown-item me-2">Dashboard</Link>
                            </li>
                            <li>
                                <Link :href="route('logout')" method="post" as="button" class="dropdown-item">Logout
                                </Link>
                            </li>
                        </ul>
                    </li>
                </div>
                <div v-else class="d-flex align-items-center ms-lg-3">
                    <Link :href="route('login')" class="login-signup-btn me-2"><font-awesome-icon
                        icon="fa-solid fa-person-circle-plus" class="text-warning me-2" />Login/Signup</Link>
                    <Link :href="route('restaurant.login')" class="login-signup-btn" style="background-color: #28a745">
                    <font-awesome-icon icon="fa-solid fa-utensils" class="me-2" />Restaurant Login</Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';
// import { useCartStore } from '@/store/cartStore';

const user = computed(() => (usePage().props.auth && usePage().props.auth.user ? usePage().props.auth.user : null));
// const cart = useCartStore();
</script>


<style scoped>
.nav-item .nav-link.active {
    background-color: #ff7e00;
    color: white !important;
    border-radius: 20px;
    padding: 6px 15px;
}
</style>
