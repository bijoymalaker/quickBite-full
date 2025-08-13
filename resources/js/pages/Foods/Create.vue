<template>
  <Layout>
    <div class="container mx-auto px-4 py-8">
      <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Add New Food Item</h1>
        
        <form @submit.prevent="submitForm" class="bg-white rounded-lg shadow-md p-6">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Food Name</label>
            <input 
              v-model="form.name" 
              type="text" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Restaurant</label>
            <select 
              v-model="form.restaurant_id" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
              <option value="">Select a restaurant</option>
              <option v-for="restaurant in restaurants" :key="restaurant.id" :value="restaurant.id">
                {{ restaurant.name }}
              </option>
            </select>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <select 
              v-model="form.category" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
              <option value="">Select category</option>
              <option value="appetizer">Appetizer</option>
              <option value="main-course">Main Course</option>
              <option value="dessert">Dessert</option>
              <option value="beverage">Beverage</option>
              <option value="snack">Snack</option>
              <option value="breakfast">Breakfast</option>
              <option value="lunch">Lunch</option>
              <option value="dinner">Dinner</option>
            </select>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
            <input 
              v-model="form.price" 
              type="number" 
              step="0.01"
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea 
              v-model="form.description" 
              rows="4"
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            ></textarea>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Image URL</label>
            <input 
              v-model="form.image" 
              type="url" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
            >
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
              <input 
                v-model="form.is_available" 
                type="checkbox" 
                class="mr-2"
              >
              Available
            </label>
          </div>

          <div class="flex justify-end space-x-4">
            <button 
              type="button" 
              @click="router.push('/foods')"
              class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
            >
              Cancel
            </button>
            <button 
              type="submit"
              class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
            >
              Add Food
            </button>
          </div>
        </form>
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

const form = ref({
  name: '',
  restaurant_id: '',
  category: '',
  price: 0,
  description: '',
  image: '',
  is_available: true
})

const fetchRestaurants = async () => {
  try {
    const response = await axios.get('/api/restaurants')
    restaurants.value = response.data
  } catch (error) {
    console.error('Error fetching restaurants:', error)
  }
}

const submitForm = async () => {
  try {
    await axios.post('/api/foods', form.value)
    router.push('/foods')
  } catch (error) {
    console.error('Error adding food:', error)
  }
}

onMounted(() => {
  fetchRestaurants()
})
</script>
