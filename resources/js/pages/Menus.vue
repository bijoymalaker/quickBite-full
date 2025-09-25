<template>
    <Layout>
        <div class="container my-5">
            <h2 class="fw-bold text-center text-primary">Browse Our Menu</h2>
            <p class="text-center text-muted">Discover delicious meals and snacks at QuickBite.</p>

            <!-- Category Tabs -->
            <ul class="nav nav-pills justify-content-center mb-4 d-none d-md-flex" role="tablist">
                <li class="nav-item" v-for="category in categories" :key="category">
                    <button class="nav-link" :class="{ active: category === selectedCategory }"
                        @click="selectedCategory = category">
                        {{ category }}
                    </button>
                </li>
            </ul>
            
            <select class="form-select mb-4 d-md-none" v-model="selectedCategory">
                <option v-for="category in categories" :key="category" :value="category">
                    {{ category }}
                </option>
            </select>
            <hr />

            <!-- Menu Items -->
            <div class="row">
                <div class="col-md-4 mb-4" v-for="item in filteredMenu" :key="item.id">
                    <div class="card shadow-sm">
                        <img :src="item.image ? '/storage/' + item.image : 'https://via.placeholder.com/400x300'" class="card-img-top" :alt="item.name">
                        <div class="card-body">
                            <h5 class="card-title">{{ item.name }}</h5>
                            <p class="card-text text-muted">{{ item.description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-success">৳{{ item.price }}</span>
                                <button class="btn btn-primary btn-sm" @click="addToCart(item)" :disabled="!item.is_available">
                                    {{ item.is_available ? 'Add to Cart' : 'Unavailable' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" v-if="filteredMenu.length === 0">
                    <div class="text-center py-5">
                        <h4>No products found in this category</h4>
                        <p>Try selecting a different category</p>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '@/layout/Layout.vue';
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { useCartStore } from '@/store/cartStore';

// Reactive data
const selectedCategory = ref("All");
const categories = ref(["All"]);
const menu = ref([]);
const cartStore = useCartStore();

// Fetch products from API
const fetchProducts = async () => {
    try {
        const response = await axios.get('/api/menu-products');
        menu.value = response.data;
        
        // Extract unique categories
        const uniqueCategories = [...new Set(response.data.map(item => item.category))];
        categories.value = ["All", ...uniqueCategories];
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

// Computed property for filtered menu
const filteredMenu = computed(() => {
    if (selectedCategory.value === "All") {
        return menu.value;
    }
    return menu.value.filter(item => item.category === selectedCategory.value);
});

// Add to cart function
const addToCart = (item) => {
    if (!item.is_available) return;
    cartStore.addItem(item);
    alert(`${item.name} added to cart!`);
};

// Fetch products on component mount
onMounted(() => {
    document.title = 'Menus - QuickBite';
    fetchProducts();
});
</script>

<style scoped>
.text-primary {
    color: #ff5722 !important;
}

.card {
    border-radius: 10px;
}
.card img {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    height: 300px;
    object-fit: cover;
}

.nav-pills .nav-link {
    color: #555;
}

.nav-pills .nav-link.active {
    background-color: #ff5722;
}
</style>