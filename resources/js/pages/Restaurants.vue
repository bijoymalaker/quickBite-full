<template>
  <div>
    <div class="container bg-light p-4 d-flex justify-content-between align-items-center position-relative res-bg">
      <div>
        <h2>Tandoori Pizza London</h2>
        <p>Minimum Order: £12 | Delivery in 20-30 Minutes</p>
        <button class="btn btn-warning">Open until 2:00 AM</button>
      </div>
      <div class="text-center bg-white p-4 rating-bridge">
        <h3>{{ rating }}</h3>
        <div class="star-rating">
          <span v-for="(star, index) in 5" :key="star" class="star">
            <font-awesome-icon icon="fa-solid fa-star" v-if="rating >= index + 1" class=" text-warning" />
            <font-awesome-icon icon="fa-solid fa-star-half-stroke" v-else-if="rating > index && rating < index +1" class=" text-warning" />
            <font-awesome-icon icon="fa-solid fa-star" v-else class=" text-muted" />
          </span>
        </div>
        <p>1,200+ reviews</p>
      </div>
      <img src="../assets/imgs/restuarent/Rectangle44.png" alt="Promo Image" class="" />
    </div>

    <div class="container">
      <div class="row my-4 align-items-baseline">
        <div class="col-12 col-md-2 mb-3 mb-md-0">
          <h1>Menus</h1>
          <!-- Tab navs -->
          <div class="d-md-none">
            <select class="form-select">
              <option v-for="(food, index) in foodCategory" :key="index" :value="food" :class="{ active:food === selectFoodCategory }">{{ food }}</option>
            </select>
          </div>
          <div class="nav flex-column nav-pills text-center nav-item list-group d-none d-md-flex" id="v-pills-tab" role="tablist"
            aria-orientation="vertical">
            <a v-for="(food, index) in foodCategory" :key="index" class="nav-link list-group-item"
              :class="{ active: food === selectFoodCategory, cursor: true }" @click=" selectFoodCategory = food ">{{ food }}</a>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <h1>{{ selectFoodCategory }}</h1>
          <div class="tab-content">
            <div class="tab-pane fade show active">
              <div class="row" v-if="filteredFood.length > 0">
                <div class="card p-3 shadow-sm my-3" v-for="food in filteredFood" :key="food.id">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <h4 class="fw-bold">{{ food.name }}</h4>
                      <div class="text-danger fs-5">🌶🌶🌶🌶🌶</div>
                      <p class="text-muted">
                        {{ food.details }}
                      </p>
                    </div>
                    <img :src="food.img" :alt="food.name" class="rounded-circle object-fit-cover" width="80"
                      height="80" />
                  </div>
                  <div class="mt-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-dark">Small &#163{{ food.Small }}</button>
                    <button class="btn btn-success">Medium &#163{{ food.Medium }}</button>
                    <button class="btn btn-primary">Large &#163{{ food.Large }}</button>
                    <button class="btn btn-warning">XL Large with Sauces &#163{{ food.XLarge }}</button>
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

    <ResDetails />
  </div>
</template>
<script>

import ShoppingBacket from "../components/ShoppingBacket.vue";
import ResDetails from "../components/ResDetails.vue";


//images import

import Rectangle53 from "../assets/imgs/restuarent/Rectangle53.png";
import Ellipse3 from "../assets/imgs/restuarent/Ellipse3.png";
import Ellipse6 from "../assets/imgs/restuarent/Ellipse6.png";
import Ellipse61 from "../assets/imgs/restuarent/Ellipse61.png";
import Ellipse62 from "../assets/imgs/restuarent/Ellipse62.png";
import Ellipse64 from "../assets/imgs/restuarent/Ellipse64.png";
import Ellipse65 from "../assets/imgs/restuarent/Ellipse65.png";
import Rectangle13 from "../assets/imgs/restuarent/Rectangle13.png";
import Rectangle15 from "../assets/imgs/restuarent/Rectangle15.png";
import { computed } from "vue";





export default {
  name: "Restaurants",
  props: {
    rating: {
      type: Number,
      default: 2.5 // Pass a rating like 3.5, 4.0, etc.
    }
  },
  setup() {
    // setup logic here
  },
  data() {
    return {
      selectFoodCategory: "All",
      foodCategory: ["All", "Pizzas", "Garlic Bread", "Calzone", "Kebabas", "Salads", "Cold drinks", "Happy Meal", "Desserts", "Hot drinks", "Sauces", "Orbit®"],
        foodName: [
          {
            id: 1,
            name: "Farm House Xtreme Pizza",
            food: "Pizzas",
            img: Rectangle53,
            details: "1 McChicken™, 1 Big Mac™, 1 Royal Cheeseburger, 3 medium-sized French fries, 2 cold drinks",
            Small: 21.99,
            Medium: 25.99,
            Large: 27.99,
            XLarge: 32.99,
          },
          {
            id: 2,
            name: "Deluxe Bread",
            food: "Garlic Bread",
            img: Ellipse3,
            details: "1 McChicken™, 1 Big Mac™,  1 Royal Cheeseburger, 3 medium sized French Fries , 3 cold drinks",
            Small: 21.90,
            Medium: 25.90,
            Large: 27.90,
            XLarge: 32.90,
          },
          {
            id: 3,
            name: "Tandoori Calzone",
            food : "Calzone",
            img: Ellipse6,
            details: "1 McChicken™, 1 Big Mac™,  1 Royal Cheeseburger, 3 medium sized French Fries , 3 cold drinks",
            Small: 21.90,
            Medium: 25.90,
            Large: 27.90,
            XLarge: 32.90,
          },
          {
            id: 4,
            name: "Pepperoni Kebabas",
            food: "Kebabas",
            img: Ellipse61,
            details: "1 McChicken™, 1 Big Mac™,  1 Royal Cheeseburger, 3 medium sized French Fries , 3 cold drinks",
            Small: 21.90,
            Medium: 25.90,
            Large: 27.90,
            XLarge: 32.90,
          },
          {
            id: 5,
            name: "Margherita Salads",
            food : "Salads",
            img: Ellipse62,
            details: "1 McChicken™, 1 Big Mac™,  1 Royal Cheeseburger, 3 medium sized French Fries , 3 cold drinks",
            Small: 21.90,
            Medium: 25.90,
            Large: 27.90,
            XLarge: 32.90,
          },
          {
            id: 6,
            name: "Hawaiian Desserts",
            food : "Desserts",
            img: Ellipse64,
            details: "1 McChicken™, 1 Big Mac™,  1 Royal Cheeseburger, 3 medium sized French Fries , 3 cold drinks",
            Small: 21.90,
            Medium: 25.90,
            Large: 27.90,
            XLarge: 32.90,
          },
          {
            id: 7,
            name: "Vegetarian Pizza",
            img: Ellipse65,
            details: "1 McChicken™, 1 Big Mac™,  1 Royal Cheeseburger, 3 medium sized French Fries , 3 cold drinks",
            Small: 21.90,
            Medium: 25.90,
            Large: 27.90,
            XLarge: 32.90,
          },
          {
            id: 8,
            name: "Meat Feast Pizza",
            img: Rectangle13,
            details: "1 McChicken™, 1 Big Mac™,  1 Royal Cheeseburger, 3 medium sized French Fries , 3 cold drinks",
            Small: 21.90,
            Medium: 25.90,
            Large: 27.90,
            XLarge: 32.90,
          },
          {

            name: "Chicken Supreme Pizza",
            img: Rectangle15,
            details: "1 McChicken™, 1 Big Mac™,  1 Royal Cheeseburger, 3 medium sized French Fries , 3 cold drinks",
            Small: 21.90,
            Medium: 25.90,
            Large: 27.90,
            XLarge: 32.90,
          },
        ],
        };
      },
    computed: {
        filteredFood() {
          if (this.selectFoodCategory === "All") {
            return this.foodName
          }
          else if( this.selectFoodCategory == "" ){
            return "Not avaliable"
          } 
          else{
            return this.foodName.filter(food => food.food === this.selectFoodCategory)
          }
            
        }
      },
    components: {
      ShoppingBacket, ResDetails
    },
  };
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
  .cursor{
    cursor: pointer;
  }
  
</style>
