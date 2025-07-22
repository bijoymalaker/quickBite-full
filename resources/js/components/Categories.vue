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
            <div class="card category-card">
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
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Pagination, Navigation } from "vue3-carousel";



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
  data() {
    return {
      categories: [
        {
          name: "Burgers & Fast food",
          img: Rectangle13,
          restaurantCount: "21 Restaurants",
        },
        {
          name: "Salads",
          img: Rectangle15,
          restaurantCount: "32 Restaurants",
        },
        {
          name: "Pasta & Casuals",
          img: Rectangle17,
          restaurantCount: "4 Restaurants",
        },
        {
          name: "Pizza",
          img: Rectangle19,
          restaurantCount: "32 Restaurants",
        },
        {
          name: "Breakfast",
          img: Rectangle21,
          restaurantCount: "4 Restaurants",
        },
        {
          name: "Soups",
          img: Rectangle23,
          restaurantCount: "32 Restaurants",
        },
      ],
    };
  },
};
</script>
