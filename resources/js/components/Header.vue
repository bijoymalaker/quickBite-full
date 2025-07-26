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
              <Link :href="route('restaurants')" class="nav-link" :class="{ active: route().current('restaurants') }">Restaurants</Link>
            </li>
            <li class="nav-item">
              <Link :href="route('tracking')" class="nav-link" :class="{ active: route().current('tracking') }">Track your Order</Link>
            </li>
          </ul>

          <!-- Login/Signup Button -->
          <Link href="login" class="login-signup-btn ms-lg-3"><font-awesome-icon icon="fa-solid fa-person-circle-plus" class="me-2 text-warning" />Login/Signup</Link>
        </div>
      </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import {route} from 'ziggy-js';

</script>
<style></style>
