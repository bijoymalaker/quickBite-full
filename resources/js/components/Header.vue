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
          </ul>

          <!-- Login/Signup Button -->

          <!-- Login/Signup or Dashboard/Logout Buttons -->
          <div v-if="user" class="d-flex align-items-center ms-lg-3">
              <Link :href="route('products.index')" class="login-signup-btn me-2">Products</Link>
              <Link :href="route('dashboard')" class="login-signup-btn me-2">Dashboard</Link>
              <Link :href="route('logout')" method="post" as="button" class="login-signup-btn">Logout</Link>
          </div>
          <Link v-else :href="route('login')" class="login-signup-btn ms-lg-3"><font-awesome-icon icon="fa-solid fa-person-circle-plus" class="me-2 text-warning" />Login/Signup</Link>
        </div>
      </div>
    </nav>
</template>

<script setup lang="ts">

import { Link, usePage } from '@inertiajs/vue3';
import {route} from 'ziggy-js';
import { computed } from 'vue';

const user = computed(() => (usePage().props.auth as { user: object | null }).user);

</script>
<style scoped>

.nav-item .nav-link.active {
    background-color: #FF7E00;
    color: white !important;
    border-radius: 20px;
    padding: 6px 15px;
}
</style>
