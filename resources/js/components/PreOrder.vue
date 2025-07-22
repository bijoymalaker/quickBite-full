<template>
    <div class="modal fade show d-block" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Special Offers > Meal Deal 1</h5>
            <button type="button" class="btn-close" @click="$emit('close')"></button>
          </div>
          <div class="modal-body">
            <div class="text-center mb-3">
              <img :src="mealImage" alt="Meal Image" class="img-fluid rounded" />
            </div>
            <h6>Please select your first Pizza</h6>
            <div class="list-group">
              <div 
                v-for="(pizza, index) in pizzas" 
                :key="index" 
                class="list-group-item d-flex align-items-center justify-content-between" 
                :class="{ 'selected': selectedPizza === pizza.name }"
                @click="selectPizza(pizza.name)"
              >
                <div class="d-flex align-items-center">
                  <img :src="pizza.image" alt="Pizza" class="rounded-circle me-2" width="40" height="40" />
                  <span :class="{ 'text-warning': selectedPizza === pizza.name }">{{ pizza.name }}</span>
                </div>
                <div class="d-flex align-items-center">
                  <button class="btn btn-sm btn-outline-secondary" @click.stop="decreaseQuantity(pizza.name)">-</button>
                  <span class="mx-2">{{ pizza.quantity }}</span>
                  <button class="btn btn-sm btn-outline-secondary" @click.stop="increaseQuantity(pizza.name)">+</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <span class="fw-bold">Total to pay: <span class="text-warning">&pound;{{ totalPrice.toFixed(2) }}</span></span>
            <div>
              <button class="btn btn-light" @click="$emit('close')">Take me back</button>
              <button class="btn btn-success ms-2">Next Step</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        mealImage: require('@/assets/imgs/meal.png'), // Adjust path
        pizzas: [
          { name: 'Margherita', image: require('@/assets/imgs/margherita.png'), quantity: 1 },
          { name: 'Polo', image: require('@/assets/imgs/polo.png'), quantity: 1 },
          { name: 'Meat Fiest', image: require('@/assets/imgs/meat.png'), quantity: 1 },
          { name: 'Hawaiian', image: require('@/assets/imgs/hawaiian.png'), quantity: 2 },
          { name: 'Toscana', image: require('@/assets/imgs/toscana.png'), quantity: 1 }
        ],
        selectedPizza: 'Hawaiian',
        basePrice: 127.90
      };
    },
    computed: {
      totalPrice() {
        return this.basePrice; // Assuming fixed price for now
      }
    },
    methods: {
      selectPizza(name) {
        this.selectedPizza = name;
      },
      increaseQuantity(name) {
        const pizza = this.pizzas.find(p => p.name === name);
        if (pizza) pizza.quantity++;
      },
      decreaseQuantity(name) {
        const pizza = this.pizzas.find(p => p.name === name);
        if (pizza && pizza.quantity > 1) pizza.quantity--;
      }
    }
  };
  </script>
  
  <style scoped>
  .selected {
    background-color: #000;
    color: white;
  }
  </style>