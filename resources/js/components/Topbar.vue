<template lang="">
      <!-- Top Bar -->
    <div class="container-fluid bg-light pb-2">
        <div class="container d-flex align-items-center justify-content-between">

            <!-- Promo Section -->
            <div class="d-flex align-items-center topbar-font">
                <!-- <font-awesome-icon icon="fa-solid fa-star" /> -->
                <font-awesome-icon icon="fa-solid fa-star" class="red me-2"/>
                <span>Get 5% Off your first order,</span>
                <a href="#" class="change-location ms-2">Promo: ORDERS</a>
            </div>

            <!-- Location Section -->
            <div class="d-flex align-items-center topbar-font">
                <span class="location-text"><font-awesome-icon icon="fa-solid fa-location-dot" class="me-2"/>Regent Street, A4, A4201,
                    London</span>
                <a href="#" class="change-location ms-2">Change Location</a>
            </div>

            <!-- Cart Section -->
            <div class="cart-info topbar-font">
                <span class="cart-icon px-3"><font-awesome-icon icon="fa-solid fa-basket-shopping" /></span>
                <!-- Emoji or icon for the cart -->
                <span class="px-3 border-end border-2">23 Items</span>
                <span class="px-3 border-end border-2">GBP 79.89</span>
                <span class="cart-icon ms-3 border-0"><font-awesome-icon icon="fa-regular fa-circle-down" /></span>
            </div>

        </div>
    </div>

</template>
<script>

    export default {
        name: "Topbar",
        
    }
</script>
<style scoped>
   .red{
         color: red;
   }
    .topbar-font{
         font-size: 14px;
    }
</style>