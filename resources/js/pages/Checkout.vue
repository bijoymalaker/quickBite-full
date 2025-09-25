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
                  <input type="text" class="form-control" v-model="billing.name" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" v-model="billing.email" required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="tel" class="form-control" v-model="billing.phone" required>
                </div>

                <!-- Delivery Address -->
                <div class="mb-3">
                  <label class="form-label">Delivery Address</label>
                  <textarea class="form-control" v-model="billing.address" rows="3" required></textarea>
                </div>

                <!-- Payment Method -->
                <div class="mb-3">
                  <label class="form-label">Payment Method</label>
                  <select class="form-select" v-model="billing.paymentMethod" required>
                    <option value="">Select payment method</option>
                    <option value="cash">Cash on Delivery</option>
                    <option value="card">Online Transection</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary w-100" :disabled="isSubmitting">
                  <span v-if="isSubmitting" class="spinner-border spinner-border-sm me-2"></span>
                  {{ isSubmitting ? 'Redirecting to Payment Gateway...' : 'Place Order' }}
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
import { ref, reactive, computed, onMounted } from 'vue';
import Layout from '@/layout/Layout.vue';
import { useCartStore } from '@/store/cartStore';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const cart = useCartStore();

const discount = ref(3.00);
const deliveryFee = ref(0);
const isSubmitting = ref(false);
const billing = reactive({
  name: '',
  email: '',
  phone: '',
  address: '',
  paymentMethod: ''
});

const total = computed(() => {
  return cart.cartTotal - discount.value + deliveryFee.value;
});

onMounted(() => {
  if (cart.items.length > 0) {
    const restaurantId = cart.items[0].restaurant_id;
    axios.get(`/api/restaurants/${restaurantId}`).then(response => {
      deliveryFee.value = parseFloat(response.data.delivery_fee);
    }).catch(error => {
      console.error('Error fetching restaurant:', error);
    });
  }
});

const placeOrder = () => {
    isSubmitting.value = true;

    if (billing.paymentMethod === 'card') {
      // Create a form and submit to /pay like exampleHosted.blade.php
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '/pay';

      // Add CSRF token
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
      const csrfInput = document.createElement('input');
      csrfInput.type = 'hidden';
      csrfInput.name = '_token';
      csrfInput.value = csrfToken;
      form.appendChild(csrfInput);

      // Add form data as hidden inputs
      const formData = {
        customer_name: billing.name,
        customer_email: billing.email,
        customer_mobile: billing.phone,
        address: billing.address,
        amount: total.value,
        cart: cart.items
      };

      Object.keys(formData).forEach(key => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = formData[key] || '';
        form.appendChild(input);
      });

      document.body.appendChild(form);
      form.submit();
    } else if (billing.paymentMethod === 'cash') {
      // Handle cash on delivery by calling backend API
      fetch('/orders/cash', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({
          name: billing.name,
          email: billing.email,
          phone: billing.phone,
          address: billing.address,
          amount: total.value,
          cart: cart.items
        })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Failed to place order');
        }
        return response.json();
      })
      .then(data => {
        alert('Order placed successfully! Pay on delivery.');
        cart.clearCart();
        router.visit('/tracking?order=' + data.order.transaction_id);
      })
      .catch(error => {
        alert('Error placing order: ' + error.message);
      })
      .finally(() => {
        isSubmitting.value = false;
      });
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
