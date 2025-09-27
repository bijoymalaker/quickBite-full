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
                <div class="col-md-4 mb-4" v-for="item in menu" :key="item.id">
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
                <div class="col-12" v-if="menu.length === 0">
                    <div class="text-center py-5">
                        <h4>No products found in this category</h4>
                        <p>Try selecting a different category</p>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4" v-if="totalPages > 1">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <button class="page-link" @click="prevPage" :disabled="currentPage === 1">Previous</button>
                        </li>
                        <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
                            <button class="page-link" @click="goToPage(page)">{{ page }}</button>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <button class="page-link" @click="nextPage" :disabled="currentPage === totalPages">Next</button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '@/layout/Layout.vue';
import { ref, computed, onMounted, watch } from 'vue';
import axios from 'axios';
import { useCartStore } from '@/store/cartStore';

// Reactive data
const selectedCategory = ref("All");
const categories = ref(["All"]);
const menu = ref([]);
const cartStore = useCartStore();

// Pagination state
const currentPage = ref(1);
const perPage = 9;
const totalPages = ref(1);

// Fetch categories from API
const fetchCategories = async () => {
    try {
        const response = await axios.get('/api/categories');
        categories.value = ["All", ...response.data.map(cat => cat.category)];
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

// Fetch products from API with pagination and category filter
const fetchProducts = async () => {
    try {
        const params = {
            page: currentPage.value,
            per_page: perPage,
        };
        if (selectedCategory.value !== "All") {
            params.category = selectedCategory.value;
        }
        const response = await axios.get('/api/menu-products', { params });
        // The paginated response data structure includes data array and meta info
        menu.value = response.data.data;
        totalPages.value = response.data.last_page || 1;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

// Watch for category changes to reset page and fetch products
watch(selectedCategory, () => {
    currentPage.value = 1;
    fetchProducts();
});

// Add to cart function
const addToCart = (item) => {
    if (!item.is_available) return;
    cartStore.addItem(item);
    alert(`${item.name} added to cart!`);
};

// Pagination controls
const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
        fetchProducts();
    }
};

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
        fetchProducts();
    }
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
        fetchProducts();
    }
};

// Fetch products on component mount
onMounted(() => {
    document.title = 'Menus - QuickBite';
    fetchCategories().then(() => {
        fetchProducts();
    });
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