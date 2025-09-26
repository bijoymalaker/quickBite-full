<template>
  <Layout>
    <title>Restaurants - QuickBite</title>
    <div class="container py-5">
      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div class="d-flex align-items-center mb-2 mb-md-0">
          <h1 class="h2 mb-0 me-3">Restaurants</h1>
          <div class="dropdown">
            <select v-model="selectedCuisine" class="form-select" style="width: auto;">
              <option value="All">All Cuisines</option>
              <option v-for="cuisine in uniqueCuisines" :key="cuisine" :value="cuisine">
                {{ cuisine }}
              </option>
            </select>
          </div>
        </div>
        <div v-if="$page.props.auth.user && $page.props.auth.user.role === 'restaurant'">
          <button @click="createRestaurant" class="btn btn-primary">
          Add Restaurant
        </button>
        </div>
      </div>

      <div class="row">
        <div v-for="restaurant in filteredRestaurants" :key="restaurant.id" class="col-12 col-md-6 col-lg-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img :src="restaurant.image ? '/storage/' + restaurant.image : 'https://via.placeholder.com/400x300'" :alt="restaurant.name" class="card-img-top"
              style="height: 200px; object-fit: cover;" />
            <div class="card-body">
              <h5 class="card-title">{{ restaurant.name }}</h5>
              <p class="card-text text-muted">{{ restaurant.cuisine_type }}</p>
              <p class="card-text text-muted small">{{ restaurant.address }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-success fw-bold">৳{{ restaurant.delivery_fee }} delivery</span>
                <div class="btn-group" role="group">
                  <button @click="viewRestaurant(restaurant.id)" class="btn btn-primary btn-sm">
                    View Foods
                  </button>
                  <button @click="editRestaurant(restaurant)" class="btn btn-warning btn-sm">
                    Edit
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import Layout from '@/layout/Layout.vue'

const { restaurants } = defineProps({
  restaurants: {
    type: Array,
    required: true
  }
})

const selectedCuisine = ref('All')

const uniqueCuisines = computed(() => {
  return [...new Set(restaurants.map(r => r.cuisine_type))]
})

const filteredRestaurants = computed(() => {
  if (selectedCuisine.value === 'All') {
    return restaurants
  }
  return restaurants.filter(r => r.cuisine_type === selectedCuisine.value)
})

const viewRestaurant = (id) => {
  router.visit(`/restaurants/${id}/foods`)
}

const editRestaurant = (restaurant) => {
  router.visit(`/restaurants/${restaurant.id}/edit`)
}

const createRestaurant = () => {
  router.visit('/restaurants/create')
}
</script>
