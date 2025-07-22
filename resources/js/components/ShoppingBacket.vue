<template>
  <div class="container mt-4">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h5 class="mb-0"><font-awesome-icon icon="fa-solid fa-basket-shopping" class="me-2" /> My Basket</h5>
      </div>
      <div class="card-body">
        <div v-for="(item, index) in cart" :key="index" class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <strong>{{ item.quantity }}x</strong> {{ item.name }} <br />
            <small>{{ item.description }}</small>
          </div>
          <div class="fw-bold">£{{ (item.price * item.quantity).toFixed(2) }}</div>
          <div class="btn-group ms-3">
            <button class="btn btn-success btn-sm ms-2"><font-awesome-icon
                icon="fa-regular fa-pen-to-square" /></button>
            <button class="btn btn-danger btn-sm"><font-awesome-icon icon="fa-regular fa-trash-can" /></button>
          </div>
        </div>

        <hr />
        <div class="d-flex justify-content-between">
          <span>Sub Total:</span>
          <span>£{{ subTotal.toFixed(2) }}</span>
        </div>
        <div class="d-flex justify-content-between text-danger">
          <span>Discounts:</span>
          <span>-£{{ discount.toFixed(2) }}</span>
        </div>
        <div class="d-flex justify-content-between">
          <span>Delivery Fee:</span>
          <span>£{{ deliveryFee.toFixed(2) }}</span>
        </div>

        <div class="bg-warning p-2 text-center fw-bold mt-3">
          Total to pay: £{{ total.toFixed(2) }}
        </div>

        <div class="mt-3">
          <button class="btn btn-outline-secondary w-100 mb-2">Choose your free item</button>
          <input type="text" class="form-control mb-2" placeholder="Apply Coupon Code" />
        </div>

        <div class="d-flex justify-content-between mt-3">
          <button class="btn btn-success w-50 me-2"><font-awesome-icon icon="fa-solid fa-person-biking"
              class="fs-2" /><br />Delivery</button>
          <button class="btn btn-outline-secondary w-50"><font-awesome-icon icon="fa-solid fa-store"
              class="fs-2" /><br />Collection</button>
        </div>

        <div v-if="total < minimumDelivery" class="alert alert-danger text-center mt-3">
          Minimum delivery is £20. You must spend £{{ (minimumDelivery - total).toFixed(2) }} more for checkout!
        </div>

        <button @mouseover="showAlert = true" @mouseleave="showAlert = false" :disabled="total < minimumDelivery" class="btn btn-primary w-100 mt-3" @click="$emit('PreOrder')">
          <font-awesome-icon icon="fa-regular fa-circle-right" class="me-5 fs-2" /> Checkout!
        </button>
      </div>
    </div>
    <div class="alert-container" v-show="showAlert">
      <div class="alert alert-dark text-white d-flex flex-column align-items-center p-3">
        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
        <p class="mb-0 text-center">
          We are open now, but delivery starts at <span class="text-warning fw-bold">18:00</span>.
          However, you may order and collect in store now.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ShoppingBasket",
  emits : ['PreOrder'],
  data() {
    return {
      showAlert: false,
      cart: [
        { name: "12\" Vegetarian Pizza", description: "Mushrooms + Green Peppers", price: 27.90, quantity: 1 },
        { name: "17\" Tandoori Pizza", description: "Mushrooms + Green Peppers", price: 17.90, quantity: 1 },
        { name: "Coke Coca Cola", description: "", price: 4.90, quantity: 2 },
        { name: "12\" Vegetarian Pizza", description: "Mushrooms + Green Peppers", price: 27.90, quantity: 1 }
      ],
      discount: 3.00,
      deliveryFee: 2.50,
      minimumDelivery: 20,
      deliveryTime: "18:00",
      showAlert: false,
    };
  },
  computed: {
    subTotal() {
      return this.cart.reduce((total, item) => total + item.price * item.quantity, 0);
    },
    total() {
      return this.subTotal - this.discount + this.deliveryFee;
    }
  }
};
</script>

<style scoped>
.card {
  max-width: 400px;
  margin: auto;
}

.alert-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.alert {
  background-color: #0a0a0a;
  border-radius: 10px;
  max-width: 400px;
  text-align: center;
}
</style>