<template>
  <Layout>
    <div class="container mt-4">
      <div class="row">
        <!-- Order Summary -->
        <div class="col-md-5">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0"><font-awesome-icon icon="fa-solid fa-receipt" class="me-2" /> Order Summary</h5>
            </div>
            <div class="card-body">
              <div v-for="(item, index) in cart.items" :key="index" class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <strong>{{ item.quantity }}x</strong> {{ item.name }} <br />
                  <small class="text-muted">{{ item.description }}</small>
                </div>
                <div class="fw-bold">৳{{ (parseFloat(item.price) * item.quantity).toFixed(2) }}</div>
              </div>

              <hr />
              <div class="d-flex justify-content-between">
                <span>Sub Total:</span>
                  <span>৳{{ cart.cartTotal.toFixed(2) }}</span>
              </div>
              <div class="d-flex justify-content-between text-danger">
                <span>Discounts:</span>
                  <span>-৳{{ discount.toFixed(2) }}</span>
              </div>
              <div class="d-flex justify-content-between">
                <span>Delivery Fee:</span>
                  <span>৳{{ deliveryFee.toFixed(2) }}</span>
              </div>
              <hr />
              <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total:</span>
                  <span>৳{{ total.toFixed(2) }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Checkout Form -->
        <div class="col-md-7">
          <div class="card">
            <div class="card-header bg-success text-white">
              <h5 class="mb-0"><font-awesome-icon icon="fa-solid fa-credit-card" class="me-2" /> Checkout</h5>
            </div>
            <div class="card-body">
              <form @submit.prevent="placeOrder">
                <!-- Customer Information -->
                <div class="mb-3">
                  <label class="form-label">Full Name</label>
                  <input type="text" class="form-control" v-model="form.name" required>
                </div>
                
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" v-model="form.email" required>
                </div>
                
                <div class="mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" v-model="form.phone" required>
                </div>

                <!-- Delivery Address -->
                <div class="mb-3">
                  <label class="form-label">Delivery Address</label>
                  <textarea class="form-control" v-model="form.address" rows="3" required></textarea>
                </div>

                <!-- Payment Method -->
                <div class="mb-3">
                  <label class="form-label">Payment Method</label>
                  <select class="form-select" v-model="form.paymentMethod" required>
                    <option value="">Select payment method</option>
                    <option value="cash">Cash on Delivery</option>
                    <option value="card">Online Transection</option>
                  </select>
                </div>

                <!-- Special Instructions -->
                <div class="mb-3">
                  <label class="form-label">Special Instructions (Optional)</label>
                  <textarea class="form-control" v-model="form.instructions" rows="2"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100" :disabled="isSubmitting">
                  <span v-if="isSubmitting" class="spinner-border spinner-border-sm me-2"></span>
                  {{ isSubmitting ? 'Processing...' : 'Place Order' }}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import Layout from '@/layout/Layout.vue';
import { useCartStore } from '@/store/cartStore';
import { router } from '@inertiajs/vue3';

const cart = useCartStore();

const discount = ref(3.00);
const deliveryFee = ref(2.50);
const isSubmitting = ref(false);
const form = reactive({
  name: '',
  email: '',
  phone: '',
  address: '',
  paymentMethod: '',
  instructions: ''
});

const total = computed(() => {
  return cart.cartTotal - discount.value + deliveryFee.value;
});

const placeOrder = () => {
  isSubmitting.value = true;

  if (form.paymentMethod === 'card') {
    // Send to SSL payment
    router.post('/pay', {
      name: form.name,
      email: form.email,
      phone: form.phone,
      address: form.address,
      instructions: form.instructions,
      total: total.value,
      cart: cart.items
    });
  } else if (form.paymentMethod === 'cash') {
    // Handle cash on delivery
    setTimeout(() => {
      alert('Order placed successfully! Pay on delivery.');
      cart.clearCart();
      router.visit('/tracking');
      isSubmitting.value = false;
    }, 2000);
  } else {
    alert('Please select a payment method.');
    isSubmitting.value = false;
  }
};
</script>

<style scoped>
.card {
  margin-bottom: 20px;
}

.form-label {
  font-weight: 500;
}
</style>
