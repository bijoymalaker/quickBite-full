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
                  <input v-model="form.name" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input v-model="form.email" type="email" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input v-model="form.phone" type="tel" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Address</label>
                  <textarea v-model="form.address" rows="3" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label">Cuisine Type</label>
                  <select v-model="form.cuisine_type" class="form-control" required>
                    <option value="">Select Cuisine Type</option>
                    <option value="Biryani">Biryani</option>
                    <option value="Fried Chicken">Fried Chicken</option>
                    <option value="Noodles">Noodles</option>
                    <option value="Sushi">Sushi</option>
                    <option value="Shawarma">Shawarma</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Kebab">Kebab</option>
                    <option value="Ice Cream">Ice Cream</option>
                    <option value="Soups">Soups</option>
                    <option value="Sweets">Sweets</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Pasta">Pasta</option>
                    <option value="Snacks">Snacks</option>
                    <option value="TehariKhichuri">TehariKhichuri</option>
                    <option value="Cafe">Cafe</option>
                    <option value="Burgers">Burgers</option>
                    <option value="Cakes">Cakes</option>
                    <option value="Pizza">Pizza</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label">Delivery Fee</label>
                  <input v-model="form.delivery_fee" type="number" step="0.01" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Restaurant Image</label>
                  <input @change="handleImageUpload" type="file" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                  <label class="form-label">Minimum Order</label>
                  <input v-model="form.minimum_order" type="number" step="0.01" class="form-control" value="0">
                </div>

                <div class="mb-3 form-check">
                  <input v-model="form.is_open" type="checkbox" class="form-check-input" id="isOpenCheck">
                  <label class="form-check-label" for="isOpenCheck">Is Open</label>
                </div>

                <div class="mb-3">
                  <label class="form-label">Opening Time</label>
                  <input v-model="form.opening_time" type="time" class="form-control">
                </div>

                <div class="mb-3">
                  <label class="form-label">Closing Time</label>
                  <input v-model="form.closing_time" type="time" class="form-control">
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <button type="button" @click="router.visit('/restaurants')" class="btn btn-secondary">
                    Cancel
                  </button>
                  <button type="submit" class="btn btn-primary">
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
  image: null,
  is_open: true
})

const handleImageUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.value.image = file
  }
}

const submitForm = async () => {
  try {
    const formData = new FormData()

    // Add all form fields to FormData
    Object.keys(form.value).forEach(key => {
      if (key === 'image' && form.value[key]) {
        formData.append(key, form.value[key])
      } else if (key === 'is_open') {
        // Convert boolean to integer for proper FormData handling
        formData.append(key, form.value[key] ? '1' : '0')
      } else if (form.value[key] !== null && form.value[key] !== '') {
        formData.append(key, form.value[key])
      }
    })

    await axios.post('/api/restaurants', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })

    router.visit('/restaurants')
  } catch (error) {
    console.error('Error adding restaurant:', error)
    alert('Error adding restaurant: ' + (error.response?.data?.message || error.message))
  }
}
</script>
