<template>
  <Layout>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h1 class="h3 mb-0">Add New Restaurant</h1>
            </div>
            <div class="card-body">
              <form @submit.prevent="submitForm">
                <div class="mb-3">
                  <label class="form-label">Restaurant Name</label>
                  <input 
                    v-model="form.name" 
                    type="text" 
                    class="form-control"
                    required
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input 
                    v-model="form.email" 
                    type="email" 
                    class="form-control"
                    required
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input 
                    v-model="form.phone" 
                    type="tel" 
                    class="form-control"
                    required
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label">Address</label>
                  <textarea 
                    v-model="form.address" 
                    rows="3"
                    class="form-control"
                    required
                  ></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label">Cuisine Type</label>
                  <input 
                    v-model="form.cuisine_type" 
                    type="text" 
                    class="form-control"
                    required
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label">Delivery Fee</label>
                  <input 
                    v-model="form.delivery_fee" 
                    type="number" 
                    step="0.01"
                    class="form-control"
                    required
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label">Image URL</label>
                  <input 
                    v-model="form.image" 
                    type="url" 
                    class="form-control"
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label">Minimum Order</label>
                  <input 
                    v-model="form.minimum_order" 
                    type="number" 
                    step="0.01"
                    class="form-control"
                    value="0"
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label">Opening Time</label>
                  <input 
                    v-model="form.opening_time" 
                    type="time"
                    class="form-control"
                  >
                </div>

                <div class="mb-3">
                  <label class="form-label">Closing Time</label>
                  <input 
                    v-model="form.closing_time" 
                    type="time"
                    class="form-control"
                  >
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <button 
                    type="button" 
                    @click="router.visit('/restaurants')"
                    class="btn btn-secondary"
                  >
                    Cancel
                  </button>
                  <button 
                    type="submit"
                    class="btn btn-primary"
                  >
                    Add Restaurant
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Layout from '@/layout/Layout.vue'
import axios from 'axios'

const form = ref({
  name: '',
  email: '',
  phone: '',
  address: '',
  cuisine_type: '',
  delivery_fee: 0,
  minimum_order: 0,
  opening_time: '',
  closing_time: '',
  image: ''
})

const submitForm = async () => {
  try {
    const restaurantData = {
      ...form.value,
      is_open: true
    }
    
    await axios.post('/api/restaurants', restaurantData)
    router.visit('/restaurants')
  } catch (error) {
    console.error('Error adding restaurant:', error)
    alert('Error adding restaurant: ' + (error.response?.data?.message || error.message))
  }
}
</script>
