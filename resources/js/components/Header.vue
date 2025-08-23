<template>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top py-0">
      <div class="container">
        <!-- Logo and Brand Name -->
        <Link class="navbar-brand" href="/">
          <img src="../assets/imgs/quickbiteLogo_noBG.png" alt="Logo" class=" h-50"/>
          QuickBite
        </Link>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav mb-3 mb-lg-0">
            <li class="nav-item">
              <Link :href="route('home')" class="nav-link" :class="{ active: route().current('home') }">Home</Link>
            </li>
            <li class="nav-item">
              <Link :href="route('menus')" class="nav-link" :class="{ active: route().current('menus') }">Menus</Link>
            </li>
            <li class="nav-item">
              <Link :href="route('offers')" class="nav-link" :class="{ active: route().current('offers') }">Offers</Link>
            </li>
            <li class="nav-item">
            <Link :href="route('restaurants.index')" class="nav-link" :class="{ active: route().current('restaurants.index') }">Restaurants</Link>
            </li>
            <li class="nav-item">
              <Link :href="route('tracking')" class="nav-link" :class="{ active: route().current('tracking') }">Track your Order</Link>
            </li>
            <!-- <li class="nav-item" v-if="user">
              <Link :href="route('checkout')" class="nav-link position-relative" :class="{ active: route().current('checkout') }">
                <font-awesome-icon icon="fa-solid fa-basket-shopping" class="me-1" />
                <span v-if="cart.itemCount > 0" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ cart.itemCount }}
                </span>
              </Link>
            </li> -->
          </ul>

          <!-- Login/Signup Button -->

          <!-- Login/Signup or Dashboard/Logout Buttons -->
          <div v-if="user" class="d-flex align-items-center ms-lg-3">
              <Link v-if="user.role === 'restaurant'" :href="route('restaurant.dashboard')" class="login-signup-btn me-2">Restaurant Dashboard</Link>
              <Link v-else :href="route('products.index')" class="login-signup-btn me-2">Products</Link>
              <Link :href="route('dashboard')" class="login-signup-btn me-2">Dashboard</Link>
              <Link :href="route('logout')" method="post" as="button" class="login-signup-btn">Logout</Link>
          </div>
          <div v-else class="d-flex align-items-center ms-lg-3">
              <Link :href="route('login')" class="login-signup-btn me-2"><font-awesome-icon icon="fa-solid fa-person-circle-plus" class="me-2 text-warning" />Login/Signup</Link>
              <Link :href="route('restaurant.login')" class="login-signup-btn" style="background-color: #28a745;"><font-awesome-icon icon="fa-solid fa-utensils" class="me-2" />Restaurant Login</Link>
          </div>
        </div>
      </div>
    </nav>
</template>

<script setup>

import { Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { computed } from 'vue';
// import { useCartStore } from '@/store/cartStore';

const user = computed(() => usePage().props.auth && usePage().props.auth.user ? usePage().props.auth.user : null);
// const cart = useCartStore();

</script>
<style scoped>

.nav-item .nav-link.active {
    background-color: #FF7E00;
    color: white !important;
    border-radius: 20px;
    padding: 6px 15px;
}
</style>
