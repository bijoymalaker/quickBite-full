<template>
    <title>Product Management - QuickBite</title>
    <Layout>
        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary">Product Management</h2>
                <Link :href="route('products.create')" class="btn btn-primary">
                    Add New Product
                </Link>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Availability</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td>
                                        <img :src="product.image ? '/storage/' + product.image : 'https://via.placeholder.com/50'" 
                                             alt="Product Image" class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.category }}</td>
                                    <td>£{{ product.price }}</td>
                                    <td>
                                        <span :class="product.is_available ? 'badge bg-success' : 'badge bg-danger'">
                                            {{ product.is_available ? 'Available' : 'Unavailable' }}
                                        </span>
                                    </td>
                                    <td>
                                        <Link :href="route('products.edit', product.id)" class="btn btn-sm btn-outline-primary me-2">
                                            Edit
                                        </Link>
                                        <button @click="deleteProduct(product.id)" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="products.length === 0">
                                    <td colspan="6" class="text-center">No products found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '@/layout/Layout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { onMounted } from 'vue';

const props = defineProps({
    products: Array,
});

const form = useForm({});

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        form.delete(route('products.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                alert('Product deleted successfully');
            },
        });
    }
};

onMounted(() => {
    document.title = 'Product Management - QuickBite';
});
</script>

<style scoped>
.text-primary {
    color: #ff5722 !important;
}

.card {
    border-radius: 10px;
}

.table th {
    color: #ff5722;
}
</style>