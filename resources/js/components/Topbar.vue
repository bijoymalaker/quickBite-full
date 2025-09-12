<template>
    <!-- Top Bar -->
    <div class="bg-light pb-2">
        <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 col-12">
                <!-- Promo Section -->
                <div class="d-flex align-items-center topbar-font">
                    <!-- <font-awesome-icon icon="fa-solid fa-star" /> -->
                    <font-awesome-icon icon="fa-solid fa-star" class="red me-2" />
                    <span>Get 5% Off your first order,</span>
                    <a href="#" class="change-location ms-2">Promo: ORDERS</a>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <!-- Location Section -->
                <div class="d-flex align-items-center topbar-font">
                    <span class="location-text"><font-awesome-icon icon="fa-solid fa-location-dot" class="me-2" />{{ locationText }}</span>
                    <a href="#" class="change-location ms-2">Change Location</a>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Cart Section -->
                <div class="cart-info topbar-font" v-if="user">
                    <Link :href="route('checkout')" class="text-decoration-none text-dark d-flex align-items-center justify-content-end">
                        <span class="cart-icon px-3"><font-awesome-icon icon="fa-solid fa-basket-shopping" class="text-white"/></span>
                    <!-- Emoji or icon for the cart -->
                    <span class="border-end border-2 px-3 text-white">{{ cart.itemCount }} Items</span>
                    <span class="border-end border-2 px-3 text-white">৳{{ (cart.cartTotal ?? 0).toFixed(2) }}</span>
                    <span class="cart-icon ms-3 border-0"><font-awesome-icon icon="fa-regular fa-circle-down" class="text-white" /></span>

                    </Link>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { computed, ref, onMounted } from 'vue';
import { useCartStore } from '@/store/cartStore';

const user = computed(() => usePage().props.auth && usePage().props.auth.user ? usePage().props.auth.user : null);
const cart = useCartStore();

const locationText = ref('Regent Street, A4, A4201, London');

async function fetchAddress(latitude, longitude) {
    console.log('fetchAddress called with:', latitude, longitude);
    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`);
        if (!response.ok) {
            throw new Error('Failed to fetch address');
        }
        const data = await response.json();
        console.log('fetchAddress response data:', data);
        if (data && data.display_name) {
            const fullAddress = data.display_name;
            const words = fullAddress.split(' ');
            locationText.value = words.length > 2 ? words.slice(0, 2).join(' ') + '...' : fullAddress;
            console.log('locationText updated to:', locationText.value);
        }
    } catch (error) {
        console.error('Error fetching address:', error);
        locationText.value = 'Regent Street, A4, A4201, London';
    }
}

onMounted(() => {
    console.log('Topbar mounted, starting geolocation');
    locationText.value = 'Detecting location...';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                console.log('Geolocation success:', position);
                fetchAddress(position.coords.latitude, position.coords.longitude);
            },
            (error) => {
                console.warn('Geolocation error:', error);
                locationText.value = 'Regent Street, A4, A4201, London';
            }
        );
    } else {
        console.warn('Geolocation is not supported by this browser.');
        locationText.value = 'Regent Street, A4, A4201, London';
    }
});
</script>
<style scoped>
.red {
    color: red;
}
.topbar-font {
    font-size: 14px;
}
.cart-info {
    cursor: pointer;
    
}
</style>
