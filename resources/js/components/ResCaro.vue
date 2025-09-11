<template>
    <div>
        <section>
        <div class="container my-5">
            <!-- Header Section -->
            <h2 class="category-header mb-4">Popular Restaurants</h2>

            <!-- Categories Row -->
            <div class="row g-4">
                <!-- Category Card 1 -->
                <div class="col-md-2" v-for="restaurant in restaurants" :key="restaurant.id">
                    <div class="card category-card">
                        <img :src="restaurant.image ? '/storage/' + restaurant.image : 'https://via.placeholder.com/400x300'" :alt="restaurant.name">
                        <div class="card-body text-center pp-res">
                            <p class="category-name text-white">{{ restaurant.name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    </div>
</template>
<script setup>

defineProps({
  restaurants: {
    type: Array,
    required: true
  }
})

</script>
<style>
    
</style>