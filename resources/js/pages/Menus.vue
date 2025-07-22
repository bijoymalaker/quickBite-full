<template>
    <div class="container my-5">
        <h2 class="fw-bold text-center text-primary">Browse Our Menu</h2>
        <p class="text-center text-muted">Discover delicious meals and snacks at QuickBite.</p>

        <!-- Category Tabs -->
        <ul class="nav nav-pills justify-content-center mb-4">
            <li class="nav-item" v-for="category in categories" :key="category">
                <button class="nav-link" :class="{ active: category === selectedCategory }"
                    @click="selectedCategory = category">
                    {{ category }}
                </button>
            </li>
        </ul>

        <!-- Menu Items -->
        <div class="row">
            <div class="col-md-4 mb-4" v-for="item in filteredMenu" :key="item.id">
                <div class="card shadow-sm">
                    <img :src="item.image" class="card-img-top" :alt="item.name">
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

<script>
export default {
    data() {
        return {
            selectedCategory: "All",
            categories: ["All", "Burgers", "Pizzas", "Drinks", "Desserts"],
            menu: [
                { id: 1, name: "Classic Cheeseburger", category: "Burgers", price: 5.99, description: "Juicy beef patty with cheese, lettuce & tomato.", image: "https://source.unsplash.com/400x300/?burger" },
                { id: 2, name: "BBQ Chicken Pizza", category: "Pizzas", price: 9.99, description: "Grilled chicken with tangy BBQ sauce.", image: "https://source.unsplash.com/400x300/?pizza" },
                { id: 3, name: "Coca Cola", category: "Drinks", price: 1.99, description: "Chilled refreshing drink.", image: "https://source.unsplash.com/400x300/?cola" },
                { id: 4, name: "Chocolate Brownie", category: "Desserts", price: 3.49, description: "Rich & fudgy chocolate brownie.", image: "https://source.unsplash.com/400x300/?brownie" }
            ],
            cart: []
        };
    },
    computed: {
        filteredMenu() {
            if (this.selectedCategory === "All") {
                return this.menu;
            }
            return this.menu.filter(item => item.category === this.selectedCategory);
        }
    },
    methods: {
        addToCart(item) {
            this.cart.push(item);
            alert(`${item.name} added to cart!`);
        }
    }
};
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