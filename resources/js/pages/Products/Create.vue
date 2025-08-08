<template>
    <title>Add Product - QuickBite</title>
    <Layout>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Add New Product</h3>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submit">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="name" 
                                        v-model="form.name"
                                        :class="{ 'is-invalid': form.errors.name }"
                                        required
                                    >
                                    <div class="invalid-feedback" v-if="form.errors.name">
                                        {{ form.errors.name }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea 
                                        class="form-control" 
                                        id="description" 
                                        rows="3" 
                                        v-model="form.description"
                                        :class="{ 'is-invalid': form.errors.description }"
                                    ></textarea>
                                    <div class="invalid-feedback" v-if="form.errors.description">
                                        {{ form.errors.description }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price (£)</label>
                                            <input 
                                                type="number" 
                                                step="0.01"
                                                class="form-control" 
                                                id="price" 
                                                v-model="form.price"
                                                :class="{ 'is-invalid': form.errors.price }"
                                                required
                                            >
                                            <div class="invalid-feedback" v-if="form.errors.price">
                                                {{ form.errors.price }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="category" 
                                                v-model="form.category"
                                                :class="{ 'is-invalid': form.errors.category }"
                                                required
                                            >
                                            <div class="invalid-feedback" v-if="form.errors.category">
                                                {{ form.errors.category }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input 
                                        type="file" 
                                        class="form-control" 
                                        id="image" 
                                        @change="handleImageChange"
                                        :class="{ 'is-invalid': form.errors.image }"
                                    >
                                    <div class="invalid-feedback" v-if="form.errors.image">
                                        {{ form.errors.image }}
                                    </div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input 
                                        type="checkbox" 
                                        class="form-check-input" 
                                        id="is_available" 
                                        v-model="form.is_available"
                                    >
                                    <label class="form-check-label" for="is_available">Available for Order</label>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <Link :href="route('products.index')" class="btn btn-secondary">
                                        Cancel
                                    </Link>
                                    <button type="submit" class="btn btn-primary" :disabled="form.processing">
                                        <span v-if="form.processing">Saving...</span>
                                        <span v-else>Save Product</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup lang="ts">
import Layout from '@/layout/Layout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { onMounted } from 'vue';

const form = useForm({
    name: '',
    description: '',
    price: '',
    category: '',
    image: null as File | null,
    is_available: true,
});

const handleImageChange = (e) => {
    const files = e.target.files;
    if (files.length > 0) {
        form.image = files[0];
    }
};

const submit = () => {
    form.post(route('products.store'), {
        preserveScroll: true,
        onSuccess: () => {
            alert('Product created successfully!');
        },
    });
};

onMounted(() => {
    document.title = 'Add Product - QuickBite';
});
</script>

<style scoped>
.bg-primary {
    background-color: #ff5722 !important;
}

.btn-primary {
    background-color: #ff5722;
    border-color: #ff5722;
}

.btn-primary:hover {
    background-color: #e04a1d;
    border-color: #e04a1d;
}
</style>