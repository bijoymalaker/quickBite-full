<template>
  <div>
    <section>
      <div class="container my-5">
        <!-- Header Section -->
        <h2 class="category-header mb-4">QuickBite Popular Categories 🍔</h2>

        <!-- Categories Carousel -->

        <Carousel :itemsToShow="4.5" :pagination="true" :navigation="true"
          :breakpoints="{0: {itemsToShow:1}, 640: { itemsToShow: 2 }, 768: { itemsToShow: 3 }, 1024: { itemsToShow: 4 } }">
          <Slide key="1" v-for="category in categories" :key="category.name" class="item">
            <div class="card category-card" @click="selectCategory(category.name)">
              <img :src="category.img" :alt="category.name" class="card-img-top" />
              <div class="card-body text-center">
                <p class="category-name">{{ category.name }}</p>
                <p class="restaurant-count">{{ category.restaurantCount }}</p>
              </div>
            </div>
          </Slide>
        </Carousel>
      </div>
    </section>
  </div>
</template>

<script>
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";
import axios from "axios";
import { ref, onMounted } from "vue";

// Categories image
import Rectangle13 from "../assets/imgs/popular/Rectangle13.jpg";
import Rectangle15 from "../assets/imgs/popular/Rectangle15.jpg";
import Rectangle17 from "../assets/imgs/popular/Rectangle17.jpg";
import Rectangle19 from "../assets/imgs/popular/Rectangle19.jpg";
import Rectangle21 from "../assets/imgs/popular/Rectangle21.jpg";
import Rectangle23 from "../assets/imgs/popular/Rectangle23.jpg";

export default {
  name: "Categories",
  components: {
    Carousel, Slide, Pagination, Navigation
  },
  emits: ['select-category'],
  setup() {
    const categories = ref([]);

    const imageMap = {
      "Burgers & Fast food": Rectangle13,
      "Salads": Rectangle15,
      "Pasta & Casuals": Rectangle17,
      "Pizza": Rectangle19,
      "Breakfast": Rectangle21,
      "Soups": Rectangle23,
    };

    const fetchCategories = async () => {
      try {
        const response = await axios.get('/api/categories');
        categories.value = response.data.map(cat => ({
          name: cat.category,
          img: imageMap[cat.category] || Rectangle13, // default to first image if not found
          restaurantCount: `${cat.count} Restaurants`,
        }));
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    };

    onMounted(fetchCategories);

    const selectCategory = (categoryName) => {
      this.$emit('select-category', categoryName);
    };

    return {
      categories,
      selectCategory,
    };
  },
};
</script>
