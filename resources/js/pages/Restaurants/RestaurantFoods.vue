<template>
  <Layout>
    <div class="container mx-auto px-4 py-8">
      <div class="mb-6">
        <button 
          @click="router.push('/restaurants')"
          class="text-blue-600 hover:text-blue-800 mb-4"
        >
          ← Back to Restaurants
        </button>
        <h1 class="text-3xl font-bold text-gray-800">{{ restaurant?.name || 'Restaurant' }} - Food Items</h1>
        <p class="text-gray-600">{{ restaurant?.cuisine_type }} • {{ restaurant?.address }}</p>
      </div>

      <div class="flex justify-between items-center mb-6">
        <div>
          <h2 class="text-2xl font-semibold">Menu Items</h2>
          <p class="text-gray-600">All food items available at this restaurant</p>
        </div>
        <button 
          @click="router.push(`/foods/create?restaurant=${restaurantId}`)"
          class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
          Add Food Item
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <div 
          v-for="food in foods" 
          :key="food.id"
          class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
        >
          <img 
            :src="food.image || '/placeholder-food.jpg'" 
            :alt="food.name"
            class="w-full h-48 object-cover"
          />
          <div class="p-4">
            <h3 class="text-xl font-semibold mb-2">{{ food.name }}</h3>
            <p class="text-sm text-gray-500 mb-2">{{ food.category }}</p>
            <p class="text-sm text-gray-700 mb-3">{{ food.description }}</p>
            <div class="flex justify-between items-center">
              <span class="text-lg font-bold text-green-600">${{ food.price }}</span>
              <div class="flex space-x-2">
                <button 
                  @click="editFood(food)"
                  class="bg-yellow-500 text-white px-3 py-1 rounded text-sm"
                >
                  Edit
                </button>
                <button 
                  @click="deleteFood(food.id)"
                  class="bg-red-500 text-white px-3 py-1 rounded text-sm"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="foods.length === 0" class="text-center py-8">
        <p class="text-gray-500">No food items found for this restaurant.</p>
        <button 
          @click="router.push(`/foods/create?restaurant=${restaurantId}`)"
          class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
          Add First Food Item
        </button>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import Layout from '@/layout/Layout.vue'
import axios from 'axios'

const router = useRouter()
const route = useRoute()
const restaurantId = route.params.id

const restaurant = ref(null)
const foods = ref([])

const fetchRestaurant = async () => {
  try {
    const response = await axios.get(`/api/restaurants/${restaurantId}`)
    restaurant.value = response.data
  } catch (error) {
    console.error('Error fetching restaurant:', error)
  }
}

const fetchFoods = async () => {
  try {
    const response = await axios.get(`/api/restaurants/${restaurantId}/foods`)
    foods.value = response.data
  } catch (error) {
    console.error('Error fetching foods:', error)
  }
}

const editFood = (food) => {
  router.push(`/foods/${food.id}/edit`)
}

const deleteFood = async (id) => {
  if (confirm('Are you sure you want to delete this food item?')) {
    try {
      await axios.delete(`/api/foods/${id}`)
      await fetchFoods()
    } catch (error) {
      console.error('Error deleting food:', error)
    }
  }
}

onMounted(() => {
  fetchRestaurant()
  fetchFoods()
})
</script>
