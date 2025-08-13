<template>
  <Layout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Food Items</h1>
        <div class="flex space-x-4">
          <select 
            v-model="selectedRestaurant" 
            @change="filterFoods"
            class="border border-gray-300 rounded-md px-3 py-2"
          >
            <option value="">All Restaurants</option>
            <option v-for="restaurant in restaurants" :key="restaurant.id" :value="restaurant.id">
              {{ restaurant.name }}
            </option>
          </select>
          
          <select 
            v-model="selectedCategory" 
            @change="filterFoods"
            class="border border-gray-300 rounded-md px-3 py-2"
          >
            <option value="">All Categories</option>
            <option value="appetizer">Appetizer</option>
            <option value="main-course">Main Course</option>
            <option value="dessert">Dessert</option>
            <option value="beverage">Beverage</option>
            <option value="snack">Snack</option>
            <option value="breakfast">Breakfast</option>
            <option value="lunch">Lunch</option>
            <option value="dinner">Dinner</option>
          </select>

          <button 
            @click="router.push('/foods/create')"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
          >
            Add Food
          </button>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <div 
          v-for="food in filteredFoods" 
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
            <p class="text-gray-600 mb-2">{{ food.restaurant?.name || 'Unknown Restaurant' }}</p>
            <p class="text-sm text-gray-500 mb-3">{{ food.category }}</p>
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

      <div v-if="filteredFoods.length === 0" class="text-center py-8">
        <p class="text-gray-500">No food items found.</p>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import Layout from '@/layout/Layout.vue'
import axios from 'axios'

const router = useRouter()
const foods = ref([])
const restaurants = ref([])
const selectedRestaurant = ref('')
const selectedCategory = ref('')

const fetchFoods = async () => {
  try {
    const response = await axios.get('/api/foods')
    foods.value = response.data
  } catch (error) {
    console.error('Error fetching foods:', error)
  }
}

const fetchRestaurants = async () => {
  try {
    const response = await axios.get('/api/restaurants')
    restaurants.value = response.data
  } catch (error) {
    console.error('Error fetching restaurants:', error)
  }
}

const filteredFoods = computed(() => {
  return foods.value.filter(food => {
    const matchesRestaurant = !selectedRestaurant.value || food.restaurant_id == selectedRestaurant.value
    const matchesCategory = !selectedCategory.value || food.category === selectedCategory.value
    return matchesRestaurant && matchesCategory
  })
})

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

const filterFoods = () => {
  // The computed property will automatically update
}

onMounted(() => {
  fetchFoods()
  fetchRestaurants()
})
</script>
