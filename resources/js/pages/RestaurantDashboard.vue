<template>
  <Layout>
    <div class="container-fluid py-4">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar">
          <div class="sidebar-sticky">
            <h5 class="sidebar-heading px-3 mt-4 mb-1 text-muted">Restaurant Management</h5>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <i class="fas fa-tachometer-alt me-2"></i>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <Link :href="route('products.index')" class="nav-link">
                  <i class="fas fa-utensils me-2"></i>
                  Menu Items
                </Link>
              </li>
              <li class="nav-item">
                <Link :href="route('restaurants.create')" class="nav-link">
                  <i class="fas fa-store me-2"></i>
                  Restaurant Details
                </Link>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-chart-bar me-2"></i>
                  Analytics
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 main-content">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Restaurant Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
            </div>
          </div>

          <!-- Restaurant Info Card -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Restaurant Information</h5>
                </div>
                <div class="card-body">
                  <div v-if="restaurant" class="row">
                    <div class="col-md-6">
                      <p><strong>Name:</strong> {{ restaurant.name }}</p>
                      <p><strong>Email:</strong> {{ restaurant.email }}</p>
                      <p><strong>Phone:</strong> {{ restaurant.phone }}</p>
                      <p><strong>Address:</strong> {{ restaurant.address }}</p>
                    </div>
                    <div class="col-md-6">
                      <p><strong>Cuisine Type:</strong> {{ restaurant.cuisine_type }}</p>
                      <p><strong>Status:</strong> 
                        <span :class="restaurant.is_open ? 'text-success' : 'text-danger'">
                          {{ restaurant.is_open ? 'Open' : 'Closed' }}
                        </span>
                      </p>
                      <p><strong>Delivery Fee:</strong> ${{ restaurant.delivery_fee }}</p>
                      <p><strong>Minimum Order:</strong> ${{ restaurant.minimum_order }}</p>
                    </div>
                  </div>
                  <div v-else>
                    <p class="text-muted">No restaurant information found. 
                      <Link :href="route('restaurants.create')" class="text-primary">Set up your restaurant</Link>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Stats Cards -->
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="card text-white bg-primary">
                <div class="card-body">
                  <h5 class="card-title">Total Menu Items</h5>
                  <h2 class="card-text">{{ restaurant?.products?.length || 0 }}</h2>
                  <Link :href="route('products.create')" class="text-white">Add New Item</Link>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card text-white bg-success">
                <div class="card-body">
                  <h5 class="card-title">Orders Today</h5>
                  <h2 class="card-text">0</h2>
                  <a href="#" class="text-white">View Orders</a>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card text-white bg-info">
                <div class="card-body">
                  <h5 class="card-title">Customer Rating</h5>
                  <h2 class="card-text">{{ restaurant?.rating || 'N/A' }}/5</h2>
                  <a href="#" class="text-white">View Reviews</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 mb-2">
                      <Link :href="route('products.create')" class="btn btn-primary w-100">
                        <i class="fas fa-plus me-2"></i>Add Menu Item
                      </Link>
                    </div>
                    <div class="col-md-3 mb-2">
                      <Link :href="route('restaurants.create')" class="btn btn-success w-100">
                        <i class="fas fa-edit me-2"></i>Edit Restaurant
                      </Link>
                    </div>
                    <div class="col-md-3 mb-2">
                      <button class="btn btn-warning w-100" @click="toggleRestaurantStatus">
                        <i class="fas fa-power-off me-2"></i>
                        {{ restaurant?.is_open ? 'Close' : 'Open' }} Restaurant
                      </button>
                    </div>
                    <div class="col-md-3 mb-2">
                      <button class="btn btn-info w-100">
                        <i class="fas fa-chart-line me-2"></i>View Reports
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup lang="ts">
import Layout from '@/layout/Layout.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { onMounted } from 'vue';

defineProps<{
  restaurant: any;
}>();

onMounted(() => {
  document.title = 'Restaurant Dashboard - QuickBite';
});

const toggleRestaurantStatus = () => {
  // Implement restaurant status toggle functionality
  console.log('Toggle restaurant status');
};
</script>

<style scoped>
.sidebar {
  min-height: 100vh;
  background-color: #f8f9fa;
  border-right: 1px solid #dee2e6;
}

.sidebar .nav-link {
  color: #495057;
  padding: 0.75rem 1rem;
  border-radius: 0.25rem;
}

.sidebar .nav-link:hover {
  background-color: #e9ecef;
}

.sidebar .nav-link.active {
  background-color: #007bff;
  color: white;
}

.main-content {
  padding: 20px;
}

.card {
  margin-bottom: 20px;
  border: none;
  border-radius: 0.5rem;
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
  background-color: #f8f9fa;
  border-bottom: 1px solid #dee2e6;
}

.btn {
  border-radius: 0.375rem;
}
</style>
