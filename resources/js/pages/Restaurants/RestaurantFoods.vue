<template>
  <Layout>
    <Title>{{ restaurant?.name || 'Restaurant' }} - Food Items</Title>
    <div>
      <div class="container my-4">
        <div class="d-flex justify-content-center mb-4">
          <Link href="/restaurants" class="btn btn-primary me-2">Back to Restaurants</Link>
          <Link :href="`/foods/create?restaurant=${restaurantId}`" class="btn btn-success">Add New Food Item</Link>
        </div>
      </div>

      <div class="container bg-light p-4 d-flex justify-content-between align-items-center position-relative res-bg">
        <div>
          <h2>{{ restaurant?.name || 'Restaurant' }}</h2>
          <p>Minimum Order: ৳{{ restaurant?.minimum_order || 0 }} | Delivery in 20-30 Minutes</p>
          <button class="btn btn-warning" v-if="restaurant?.is_open">Open until {{ restaurant?.closing_time }}</button>
          <button class="btn btn-secondary" v-else>Closed</button>
        </div>
        <div class="text-center bg-white p-4 rating-bridge">
          <h3>{{ restaurant?.rating || 0 }}</h3>
          <div class="star-rating">
            <span v-for="(star, index) in 5" :key="index" class="star">
              <font-awesome-icon icon="fa-solid fa-star" v-if="restaurant?.rating >= index + 1" class="text-warning" />
              <font-awesome-icon icon="fa-solid fa-star-half-stroke" v-else-if="restaurant?.rating > index && restaurant?.rating < index + 1" class="text-warning" />
              <font-awesome-icon icon="fa-solid fa-star" v-else class="text-muted" />
            </span>
          </div>
          <p>1,200+ reviews</p>
        </div>
        <img :src="restaurant?.image || '/placeholder-restaurant.jpg'" alt="Restaurant Image" class="restaurant-image" />
      </div>

      <div class="container">
        <div class="row my-4 align-items-baseline">
          <div class="col-12 col-md-2 mb-3 mb-md-0">
            <h1>Menus</h1>
            <div class="d-md-none">
              <select class="form-select" v-model="selectFoodCategory">
                <option v-for="(category, index) in foodCategory" :key="index" :value="category">{{ category }}</option>
              </select>
            </div>
            <div class="nav flex-column nav-pills text-center nav-item list-group d-none d-md-flex" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a v-for="(category, index) in foodCategory" :key="index" class="nav-link list-group-item" :class="{ active: category === selectFoodCategory, cursor: true }" @click="selectFoodCategory = category">{{ category }}</a>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <h1>{{ selectFoodCategory }}</h1>
            <div class="tab-content">
              <div class="tab-pane fade show active">
                <div class="row" v-if="filteredFoods.length > 0">
                  <div class="card p-3 shadow-sm my-3" v-for="food in filteredFoods" :key="food.id">
                    <div class="d-flex align-items-center">
                      <div class="me-3">
                        <h4 class="fw-bold">{{ food.name }}</h4>
                        <div class="text-danger fs-5">🌶🌶🌶🌶🌶</div>
                        <p class="text-muted">{{ food.description }}</p>
                      </div>
                      <img :src="food.image || '/placeholder-food.jpg'" :alt="food.name" class="rounded-circle object-fit-cover" width="80" height="80" />
                    </div>
                    <div class="mt-3 d-flex flex-wrap gap-2">
                      <button class="btn btn-dark" @click="orderFood(food, 'Small')">Small ৳{{ food.price }}</button>
                      <button class="btn btn-success" @click="orderFood(food, 'Medium')">Medium ৳{{ food.price }}</button>
                      <button class="btn btn-primary" @click="orderFood(food, 'Large')">Large ৳{{ food.price }}</button>
                      <button class="btn btn-warning" @click="orderFood(food, 'XLarge')">XLarge with Sauces ৳{{ food.price }}</button>
                    </div>
                    <div class="mt-2 d-flex gap-2">
                      <button class="btn btn-warning" @click="editFood(food)">Edit</button>
                      <button class="btn btn-danger" @click="deleteFood(food.id)">Delete</button>
                    </div>
                  </div>
                </div>
                <div class="text-center" v-else>
                  <h2>No Food Found</h2>
                </div>
              </div>
            </div>
          </div>

          <div class="col-0 col-md-4">
            <ShoppingBacket />
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import axios from 'axios'
import Layout from '@/layout/Layout.vue'
import ShoppingBacket from '@/components/ShoppingBacket.vue'

const props = defineProps({
  id: {
    type: [String, Number],
    required: true
  }
})

const restaurantId = props.id

const restaurant = ref(null)
const foods = ref([])

const foodCategory = ref(['All'])

const selectFoodCategory = ref('All')

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
    // Extract unique categories from foods
    const categories = new Set(response.data.map(food => food.category))
    foodCategory.value = ['All', ...categories]
  } catch (error) {
    console.error('Error fetching foods:', error)
  }
}

const filteredFoods = computed(() => {
  if (selectFoodCategory.value === 'All') {
    return foods.value
  } else {
    return foods.value.filter(food => food.category === selectFoodCategory.value)
  }
})

const editFood = (food) => {
  router.visit(`/products/${food.id}/edit`)
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

const orderFood = (food, size) => {
  // Placeholder for ordering logic
  alert(`Ordered ${food.name} - Size: ${size}`)
}

onMounted(() => {
  fetchRestaurant()
  fetchFoods()
})
</script>

<style scoped>
.res-bg {
  background-image: linear-gradient(rgba(226, 226, 226, 0.5), rgba(226, 226, 226, 0.5)),
    url("../assets/imgs/restuarent/Rectangle44.png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
.rating-bridge {
  border-radius: 10px;
  position: absolute;
  top: 60%;
  right: 50%;
}
.cursor {
  cursor: pointer;
}
.restaurant-image {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
}
</style>
