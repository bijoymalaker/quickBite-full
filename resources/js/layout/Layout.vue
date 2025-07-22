<script setup lang="ts">
import Topbar from '../components/Topbar.vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
</script>

<template>
  <div class="h-100">
    
    <Topbar />
    <Header />

    <slot />

    <Footer />

    

  </div>
</template>

<style>

</style>
