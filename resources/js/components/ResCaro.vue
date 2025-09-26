<template>
    <div>
        <section>
            <div class="container my-5">
                <!-- Header Section -->
                <h2 class="category-header mb-4">Popular Restaurants</h2>
                <Carousel :items-to-show="5" :pagination="true" :navigation="true"
                    :breakpoints="{ 0: { itemsToShow: 1 }, 640: { itemsToShow: 2 }, 768: { itemsToShow: 3 }, 1024: { itemsToShow: 5 } }">
                    <slide v-for="restaurant in restaurants" :key="restaurant.id">
                        <Link :href="`/restaurants/${restaurant.id}/foods`" class="text-decoration-none">
                        <div class="card category-card g-3">
                            <img :src="restaurant.image ? '/storage/' + restaurant.image : 'https://via.placeholder.com/400x300'"
                                :alt="restaurant.name">
                            <div class="card-body text-center pp-res">
                                <p class="category-name text-white">{{ restaurant.name }}</p>
                            </div>
                        </div></Link>
                    </slide>
                </Carousel>
            </div>
        </section>

    </div>
</template>
<script setup>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide } from "vue3-carousel";
import { Link } from '@inertiajs/vue3'

defineProps({
    restaurants: {
        type: Array,
        required: true
    }
})

</script>

<style scoped>
.card {
    width: 250px;
    height: auto;
}

.category-card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}
</style>