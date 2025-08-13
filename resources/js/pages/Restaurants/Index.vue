<template>
  <Layout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Restaurants</h1>
        <button 
          @click="router.push('/restaurants/create')"
          class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
          Add Restaurant
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
          v-for="restaurant in restaurants" 
          :key="restaurant.id"
          class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
        >
          <img 
            :src="restaurant.image || '/placeholder-restaurant.jpg'" 
            :alt="restaurant.name"
            class="w-full h-48 object-cover"
          />
          <div class="p-4">
            <h3 class="text-xl font-semibold mb-2">{{ restaurant.name }}</h3>
            <p class="text-gray-600 mb-2">{{ restaurant.cuisine_type }}</p>
            <p class="text-sm text-gray-500 mb-3">{{ restaurant.address }}</p>
            <div class="flex justify-between items-center">
              <span class="text-lg font-bold text-green-600">${{ restaurant.delivery_fee }} delivery</span>
              <div class="flex space-x-2">
                <button 
                  @click="viewRestaurant(restaurant.id)"
                  class="bg-blue-500 text-white px-3 py-1 rounded text-sm"
                >
                  View Foods
                </button>
                <button 
                  @click="editRestaurant(restaurant)"
                  class="bg-yellow-500 text-white px-3 py-1 rounded text-sm"
                >
                  Edit
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import Layout from '@/layout/Layout.vue'
import axios from 'axios'

const router = useRouter()
const restaurants = ref([])

const fetchRestaurants = async () => {
  try {
    const response = await axios.get('/api/restaurants')
    restaurants.value = response.data
  } catch (error) {
    console.error('Error fetching restaurants:', error)
  }
}

const viewRestaurant = (id) => {
  router.push(`/restaurants/${id}/foods`)
}

const editRestaurant = (restaurant) => {
  router.push(`/restaurants/${restaurant.id}/edit`)
}

onMounted(() => {
  fetchRestaurants()
})
</script>
