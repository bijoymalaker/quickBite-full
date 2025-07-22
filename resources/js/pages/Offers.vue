<template>
    <div class="container my-5">
        <h2 class="fw-bold text-center text-primary">Offers Page</h2>
        <p class="text-center text-muted">Discover delicious meals and snacks at QuickBite.</p>


        <!-- Menu Items -->
        <div class="row">
            <div class="col-md-4 mb-4" v-for="item in menu" :key="item.id">
                <div class="card shadow-sm">
                    <img :src="item.images" class="card-img-top" :alt="item.name">
                    <div class="card-body">
                        <h5 class="card-title">{{ item.name }}</h5>
                        <p class="card-text text-muted">{{ item.description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-success">£{{ item.price.toFixed(2) }}</span>
                            <button class="btn btn-primary btn-sm" @click="addToCart(item)">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
const menu = ref([]);

const fetchMenu = async () => {
    try {
        const response = await fetch("https://dummyjson.com/products?limit=40");
        const data = await response.json();
        console.log("Fetched Data:", data);
        menu.value = data.products;
    } catch (error) {
        console.error("Error Fetching products",error);
    }
};

onMounted(fetchMenu);

</script>

<style scoped>
.text-primary {
    color: #ff5722 !important;
}

.card {
    border-radius: 10px;
}

.nav-pills .nav-link {
    color: #555;
}

.nav-pills .nav-link.active {
    background-color: #ff5722;
}
</style>