<template>
  <Layout>
    <div class="container my-5">
      <h1>Dashboard</h1>
      <p>Welcome to your dashboard!</p>
    </div>
  </Layout>
</template>

<script setup lang="ts">
import Layout from '@/layout/Layout.vue';
import { onMounted } from 'vue';

onMounted(() => {
    document.title = 'Dashboard - Pretty Picks';
});
</script>

<style scoped>
.container {
  min-height: 400px;
}
</style>