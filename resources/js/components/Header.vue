<template>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top py-0">
      <div class="container">
        <!-- Logo and Brand Name -->
        <a class="navbar-brand" href="#">
          <img src="../assets/imgs/quickbiteLogo_noBG.png" alt="Logo" class=" h-50"/>
          QuickBite
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav mb-3 mb-lg-0">
            <li class="nav-item">
              <router-link to="/" class=" nav-link">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/menus" class=" nav-link">Browse Menu</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/offers" class=" nav-link">Special Offers</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/restaurants" class=" nav-link">Restaurants</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/tracking" class=" nav-link">Track Order</router-link>
            </li>
          </ul>

          <!-- Login/Signup Button -->
          <router-link to="/login" class="login-signup-btn ms-lg-3"><font-awesome-icon icon="fa-solid fa-person-circle-plus" class="me-2 text-warning" />Login/Signup</router-link>
        </div>
      </div>
    </nav>
</template>
<script>
export default {};
</script>
<style></style>
