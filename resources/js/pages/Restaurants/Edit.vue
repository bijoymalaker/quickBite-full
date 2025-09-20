<template>
    <title>Edit Restaurant - QuickBite</title>
    <Layout>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Edit Restaurant</h3>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submitForm">
                                <div class="mb-3">
                                    <label class="form-label">Restaurant Name</label>
                                    <input v-model="form.name" type="text" class="form-control" :class="{ 'is-invalid': errors.name }" required>
                                    <div class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input v-model="form.email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }">
                                    <div class="invalid-feedback" v-if="errors.email">{{ errors.email[0] }}</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input v-model="form.phone" type="tel" class="form-control" :class="{ 'is-invalid': errors.phone }">
                                    <div class="invalid-feedback" v-if="errors.phone">{{ errors.phone[0] }}</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea v-model="form.address" rows="3" class="form-control" :class="{ 'is-invalid': errors.address }"></textarea>
                                    <div class="invalid-feedback" v-if="errors.address">{{ errors.address[0] }}</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Cuisine Type</label>
                                    <input v-model="form.cuisine_type" type="text" class="form-control" :class="{ 'is-invalid': errors.cuisine_type }">
                                    <div class="invalid-feedback" v-if="errors.cuisine_type">{{ errors.cuisine_type[0] }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Delivery Fee</label>
                                            <input v-model.number="form.delivery_fee" type="number" step="0.01" class="form-control" :class="{ 'is-invalid': errors.delivery_fee }">
                                            <div class="invalid-feedback" v-if="errors.delivery_fee">{{ errors.delivery_fee[0] }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Minimum Order</label>
                                            <input v-model.number="form.minimum_order" type="number" step="0.01" class="form-control" :class="{ 'is-invalid': errors.minimum_order }">
                                            <div class="invalid-feedback" v-if="errors.minimum_order">{{ errors.minimum_order[0] }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Restaurant Image</label>
                                    <input @change="handleImageUpload" type="file" class="form-control" accept="image/*">
                                    <div class="mt-2" v-if="previewUrl">
                                        <small class="text-muted">New image preview:</small>
                                        <img :src="previewUrl" alt="Preview" class="img-fluid rounded mt-1" style="max-height: 120px;">
                                    </div>
                                    <div class="mt-2" v-else-if="restaurant.image">
                                        <small class="text-muted">Current image:</small>
                                        <img :src="'/storage/' + restaurant.image" alt="Current" class="img-fluid rounded mt-1" style="max-height: 120px;">
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="errors.image">{{ errors.image[0] }}</div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input v-model="form.is_open" type="checkbox" class="form-check-input" id="isOpenCheck">
                                    <label class="form-check-label" for="isOpenCheck">Is Open</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Opening Time</label>
                                            <input v-model="form.opening_time" type="time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Closing Time</label>
                                            <input v-model="form.closing_time" type="time" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" @click="router.visit('/restaurants')" class="btn btn-secondary">Cancel</button>
                                    <button type="submit" class="btn btn-primary" :disabled="submitting"> 
                                        <span v-if="submitting">Updating...</span>
                                        <span v-else>Update Restaurant</span>
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

<script setup>
import { ref, onMounted } from 'vue'
import Layout from '@/layout/Layout.vue'
import axios from 'axios'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    restaurant: {
        type: Object,
        default: () => ({
            id: null,
            name: '',
            email: '',
            phone: '',
            address: '',
            cuisine_type: '',
            delivery_fee: 0,
            minimum_order: 0,
            opening_time: '',
            closing_time: '',
            image: '',
            is_open: false,
        }),
    },
})

const restaurant = props.restaurant

const form = ref({
    name: restaurant.name || '',
    email: restaurant.email || '',
    phone: restaurant.phone || '',
    address: restaurant.address || '',
    cuisine_type: restaurant.cuisine_type || '',
    delivery_fee: restaurant.delivery_fee ?? 0,
    minimum_order: restaurant.minimum_order ?? 0,
    opening_time: restaurant.opening_time ? formatTime(restaurant.opening_time) : '',
    closing_time: restaurant.closing_time ? formatTime(restaurant.closing_time) : '',
    image: null,
    is_open: restaurant.is_open ?? false,
})

const errors = ref({})
const submitting = ref(false)
const previewUrl = ref('')

function formatTime(value) {
    // If value comes as HH:mm:ss or a date string, extract HH:mm
    if (!value) return ''
    const s = String(value)
    const m = s.match(/(\d{2}:\d{2})/) // capture HH:MM
    return m ? m[1] : s
}

const handleImageUpload = (e) => {
    const file = e.target.files && e.target.files[0]
    if (file) {
        form.value.image = file
        // create a preview URL
        previewUrl.value && URL.revokeObjectURL(previewUrl.value)
        previewUrl.value = URL.createObjectURL(file)
    }
}

const submitForm = async () => {
    submitting.value = true
    errors.value = {}

    try {
        const formData = new FormData()

        // append fields
        formData.append('name', form.value.name)
        formData.append('email', form.value.email || '')
        formData.append('phone', form.value.phone || '')
        formData.append('address', form.value.address || '')
        formData.append('cuisine_type', form.value.cuisine_type || '')
        formData.append('delivery_fee', String(form.value.delivery_fee ?? 0))
        formData.append('minimum_order', String(form.value.minimum_order ?? 0))
        formData.append('opening_time', form.value.opening_time || '')
        formData.append('closing_time', form.value.closing_time || '')
        formData.append('is_open', form.value.is_open ? '1' : '0')

        if (form.value.image) {
            formData.append('image', form.value.image)
        }

        // Use method override since the API route accepts PUT
        formData.append('_method', 'PUT')

        await axios.post(`/api/restaurants/${restaurant.id}`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
        })

        router.visit('/restaurants')
    } catch (err) {
        if (err.response && err.response.data) {
            // Laravel validation errors typically live in response.data.errors
            errors.value = err.response.data.errors || {}
            const message = err.response.data.message || (err.response.data.errors ? 'Validation failed' : '')
            if (message) {
                // show a subtle alert; keep simple
                 
                alert(message)
            }
        } else {
             
            alert(err.message || 'An error occurred')
        }
    } finally {
        submitting.value = false
    }
}

onMounted(() => {
    document.title = 'Edit Restaurant - QuickBite'
})
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