<template>
  <Layout>
    <div class="container mx-auto px-4 py-8">
      <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Add New Restaurant</h1>
        
        <form @submit.prevent="submitForm" class="bg-white rounded-lg shadow-md p-6">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Restaurant Name</label>
            <input 
              v-model="form.name" 
              type="text" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input 
              v-model="form.email" 
              type="email" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
            <input 
              v-model="form.phone" 
              type="tel" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
            <textarea 
              v-model="form.address" 
              rows="3"
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            ></textarea>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Cuisine Type</label>
            <input 
              v-model="form.cuisine_type" 
              type="text" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Fee</label>
            <input 
              v-model="form.delivery_fee" 
              type="number" 
              step="0.01"
              class="w-full border border-gray-300 rounded-md px-3 py-2"
              required
            >
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Image URL</label>
            <input 
              v-model="form.image" 
              type="url" 
              class="w-full border border-gray-300 rounded-md px-3 py-2"
            >
          </div>

          <div class="flex justify-end space-x-4">
            <button 
              type="button" 
              @click="router.push('/restaurants')"
              class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
            >
              Cancel
            </button>
            <button 
              type="submit"
              class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
            >
              Add Restaurant
            </button>
          </div>
        </form>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import Layout from '@/layout/Layout.vue'
import axios from 'axios'

const router = useRouter()

const form = ref({
  name: '',
  email: '',
  phone: '',
  address: '',
  cuisine_type: '',
  delivery_fee: 0,
  image: ''
})

const submitForm = async () => {
  try {
    await axios.post('/api/restaurants', form.value)
    router.push('/restaurants')
  } catch (error) {
    console.error('Error adding restaurant:', error)
  }
}
</script>
