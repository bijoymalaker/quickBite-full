<template>
    <title>Order Tracking - QuickBite</title>
    <Layout>
        <div class="tracking-container">
            <!-- Hero Section -->
            <div class="tracking-hero">
                <h1 class="tracking-title">Track Your Order</h1>
                <p class="tracking-subtitle">Enter your order number to track your delivery in real-time</p>
            </div>

            <!-- Order Search Section -->
            <!-- Removed search section as per user request -->
            <!-- No search UI on tracking page -->

            <!-- Order Details Section -->
            <div v-if="currentOrder" class="order-details">
                <!-- Order Header -->
                <div class="order-header">
                    <div class="order-info">
                        <h2>Order #{{ currentOrder.orderNumber }}</h2>
                        <p class="order-date">Placed on {{ formatDate(currentOrder.orderDate) }}</p>
                        <span :class="['status-badge', currentOrder.status.toLowerCase()]">
                            {{ currentOrder.status }}
                        </span>
                    </div>
                    <div class="order-summary">
                        <div class="summary-item">
                            <span>Items:</span>
                            <strong>{{ currentOrder.items.length }}</strong>
                        </div>
                        <div class="summary-item">
                            <span>Total:</span>
                            <strong>৳{{ Number(currentOrder.totalAmount).toFixed(2) }}</strong>
                        </div>
                        <div class="summary-item">
                            <span>Estimated Delivery:</span>
                            <strong>{{ formatDate(currentOrder.estimatedDelivery) }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Order Process Timeline -->
                <div class="order-process">
                    <h3>Order Process</h3>
                    <div class="process-timeline">
                        <div
                            v-for="(step, index) in progressSteps"
                            :key="index"
                            :class="['timeline-step', { active: isStepActive(step), completed: isStepCompleted(step) }]"
                        >
                            <div class="timeline-content">
                                <div class="step-icon">
                                    <i :class="step.icon"></i>
                                </div>
                                <div class="step-details">
                                    <h4>{{ step.title }}</h4>
                                    <p>{{ step.description }}</p>
                                    <span v-if="step.timestamp" class="step-time">{{ formatTime(step.timestamp) }}</span>
                                </div>
                            </div>
                            <!-- Order Details for this step (if applicable) -->
                            <div v-if="isStepCompleted(step) && step.key === 'preparing'" class="step-order-details">
                                <h5>Preparing Your Order</h5>
                                <div class="mini-items">
                                    <div v-for="item in currentOrder.items.slice(0, 2)" :key="item.id" class="mini-item">
                                        <img :src="item.image || '/placeholder-food.jpg'" :alt="item.name" class="mini-image" />
                                        <span>{{ item.name }} x{{ item.quantity }}</span>
                                    </div>
                                    <p v-if="currentOrder.items.length > 2">+{{ currentOrder.items.length - 2 }} more items</p>
                                </div>
                            </div>
                            <div v-if="isStepCompleted(step) && step.key === 'out-for-delivery'" class="step-order-details">
                                <h5>Delivery Information</h5>
                                <p><strong>Address:</strong> {{ currentOrder.deliveryAddress }}</p>
                                <p v-if="currentOrder.driver">
                                    <strong>Driver:</strong> {{ currentOrder.driver.name }} ({{ currentOrder.driver.phone }})
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="order-items">
                    <h3>Order Items</h3>
                    <div class="items-list">
                        <div v-for="item in currentOrder.items" :key="item.id" class="item-card">
                            <img :src="item.image || '/placeholder-food.jpg'" :alt="item.name" class="item-image" />
                            <div class="item-details">
                                <h4>{{ item.name }}</h4>
                                <p>{{ item.description }}</p>
                                <div class="item-meta">
                                    <span class="quantity">Qty: {{ item.quantity }}</span>
                                    <span class="price">৳{{ Number(item.price).toFixed(2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Details -->
                <div class="delivery-details">
                    <div class="delivery-info">
                        <h3>Delivery Details</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>Delivery Address</strong>
                                    <p>{{ currentOrder.deliveryAddress }}</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-user"></i>
                                <div>
                                    <strong>Customer</strong>
                                    <p>{{ currentOrder.customerName }}</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <strong>Contact</strong>
                                    <p>{{ currentOrder.customerPhone }}</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-motorcycle"></i>
                                <div>
                                    <strong>Delivery Method</strong>
                                    <p>{{ currentOrder.deliveryMethod }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Driver Info (if applicable) -->
                    <div v-if="currentOrder.driver" class="driver-info">
                        <h4>Delivery Partner</h4>
                        <div class="driver-card">
                            <img :src="currentOrder.driver.avatar || '/driver-avatar.jpg'" alt="Driver" class="driver-avatar" />
                            <div class="driver-details">
                                <h5>{{ currentOrder.driver.name }}</h5>
                                <p>Vehicle: {{ currentOrder.driver.vehicle }}</p>
                                <p>Phone: {{ currentOrder.driver.phone }}</p>
                                <div class="driver-rating">
                                    <span class="stars">★★★★☆</span>
                                    <span>{{ currentOrder.driver.rating }}/5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button @click="reorder" class="btn-reorder"><i class="fas fa-redo"></i> Reorder</button>
                    <button @click="contactSupport" class="btn-support"><i class="fas fa-headset"></i> Contact Support</button>
                    <button @click="shareOrder" class="btn-share"><i class="fas fa-share"></i> Share Order</button>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div v-if="recentOrders.length > 0" class="recent-orders">
                <h3>Recent Orders</h3>
                <div class="orders-grid">
                    <div v-for="order in recentOrders" :key="order.orderNumber" class="order-card" @click="selectOrder(order.orderNumber)">
                        <div class="order-card-header">
                            <span class="order-number">#{{ order.orderNumber }}</span>
                            <span :class="['status', order.status.toLowerCase()]">{{ order.status }}</span>
                        </div>
                        <div class="order-card-body">
                            <p>{{ order.items.length }} items • ৳{{ Number(order.totalAmount).toFixed(2) }}</p>
                            <p class="order-date">{{ formatDate(order.orderDate) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '@/layout/Layout.vue';
import { computed, onMounted, ref } from 'vue';

// Reactive data
const orderNumber = ref('');
const currentOrder = ref(null);
const isLoading = ref(false);
const recentOrders = ref([]);

// Helper functions
const formatDate = (date) => {
    return new Date(date).toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};

const formatTime = (date) => {
    return new Date(date).toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
    });
};

const getProgressTimestamp = (step) => {
    if (!currentOrder.value || !currentOrder.value.progress) return null;
    const progress = currentOrder.value.progress.find((p) => p.step === step);
    return progress ? progress.timestamp : null;
};

const isStepActive = (step) => {
    const timestamp = getProgressTimestamp(step.key);
    return timestamp !== null;
};

const isStepCompleted = (step) => {
    const currentStepIndex = progressSteps.value.findIndex((s) => s.key === step.key);
    const lastCompletedIndex = currentOrder.value?.progress?.length - 1 || 0;
    return currentStepIndex <= lastCompletedIndex;
};

// Computed
const progressSteps = computed(() => {
    return [
        {
            key: 'order-placed',
            title: 'Order Placed',
            description: 'We have received your order',
            icon: 'fas fa-clipboard-check',
            timestamp: getProgressTimestamp('order-placed'),
        },
        {
            key: 'confirmed',
            title: 'Order Confirmed',
            description: 'Restaurant has accepted your order',
            icon: 'fas fa-check-circle',
            timestamp: getProgressTimestamp('confirmed'),
        },
        {
            key: 'preparing',
            title: 'Preparing',
            description: 'Your food is being prepared',
            icon: 'fas fa-utensils',
            timestamp: getProgressTimestamp('preparing'),
        },
        {
            key: 'out-for-delivery',
            title: 'Out for Delivery',
            description: 'Your order is on its way',
            icon: 'fas fa-motorcycle',
            timestamp: getProgressTimestamp('out-for-delivery'),
        },
        {
            key: 'delivered',
            title: 'Delivered',
            description: 'Order delivered successfully',
            icon: 'fas fa-home',
            timestamp: getProgressTimestamp('delivered'),
        },
    ];
});

// Methods
const trackOrder = async () => {
    if (!orderNumber.value.trim()) {
        return;
    }

    isLoading.value = true;

    try {
        // Fetch order data from the backend API that uses the Order model
        const response = await fetch('/api/tracking?order_number=' + encodeURIComponent(orderNumber.value.trim()));

        if (response.ok) {
            const order = await response.json();
            console.log('Order fetched:', order);
            currentOrder.value = order;
        } else {
            console.error('Failed to fetch order:', response.status);
            currentOrder.value = null;
        }
    } catch (error) {
        console.error('Error fetching order:', error);
        currentOrder.value = null;
    }

    isLoading.value = false;
};

const selectOrder = (orderNum) => {
    orderNumber.value = orderNum;
    trackOrder();
};

const reorder = () => {
    alert('Reordering functionality would be implemented here');
};

const contactSupport = () => {
    alert('Contact support functionality would be implemented here');
};

const shareOrder = () => {
    if (currentOrder.value) {
        const shareText = `Check out my order #${currentOrder.value.orderNumber} from QuickBite!`;
        if (navigator.share) {
            navigator.share({
                title: 'QuickBite Order',
                text: shareText,
                url: window.location.href + '?order=' + currentOrder.value.orderNumber,
            });
        } else {
            alert(shareText);
        }
    }
};

// Lifecycle
onMounted(() => {
    // Removed loading mock orders as per user request

    // Check if order number is provided in URL
    const urlParams = new URLSearchParams(window.location.search);
    const orderNum = urlParams.get('order');
    if (orderNum) {
        orderNumber.value = orderNum;
        trackOrder();
    }
});
</script>

<style scoped>
.tracking-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.tracking-hero {
    text-align: center;
    margin-bottom: 40px;
}

.tracking-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.tracking-subtitle {
    font-size: 1.2rem;
    color: #7f8c8d;
}

.search-section {
    margin-bottom: 40px;
}

.search-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.search-form {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 20px;
}

.order-input {
    padding: 12px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 25px;
    font-size: 16px;
    width: 300px;
    transition: border-color 0.3s;
}

.order-input:focus {
    outline: none;
    border-color: #ff5722;
}

.track-btn {
    padding: 12px 30px;
    background: #ff5722;
    color: white;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.track-btn:hover:not(:disabled) {
    background: #e64a19;
}

.track-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.error-message {
    color: #e74c3c;
    margin-top: 10px;
}

.order-details {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.order-info h2 {
    margin: 0 0 5px 0;
    color: #2c3e50;
}

.order-date {
    color: #7f8c8d;
    margin: 0;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.status-badge.delivered {
    background: #2ecc71;
    color: white;
}

.status-badge.out-for-delivery {
    background: #3498db;
    color: white;
}

.status-badge.preparing {
    background: #f39c12;
    color: white;
}

.status-badge.confirmed {
    background: #9b59b6;
    color: white;
}

.order-summary {
    display: flex;
    gap: 30px;
}

.summary-item {
    text-align: center;
}

.summary-item span {
    display: block;
    color: #7f8c8d;
    font-size: 14px;
}

.order-process {
    margin-bottom: 30px;
}

.process-timeline {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
    position: relative;
}

.process-timeline::before {
    content: '';
    position: absolute;
    left: 25px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e0e0e0;
    z-index: 1;
}

.timeline-step {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    position: relative;
}

.timeline-step.completed::before {
    content: '';
    position: absolute;
    left: 21px;
    top: 50px;
    bottom: -20px;
    width: 2px;
    background: #ff5722;
    z-index: 2;
}

.timeline-step:last-child::before {
    display: none;
}

.timeline-content {
    display: flex;
    align-items: center;
    gap: 15px;
    flex: 1;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 3;
    flex-shrink: 0;
}

.timeline-step.active .step-icon,
.timeline-step.completed .step-icon {
    background: #ff5722;
    color: white;
}

.step-details {
    flex: 1;
}

.step-details h4 {
    margin: 0 0 5px 0;
    font-size: 16px;
    font-weight: 600;
}

.step-details p {
    margin: 0 0 5px 0;
    font-size: 14px;
    color: #7f8c8d;
}

.step-time {
    font-size: 12px;
    color: #ff5722;
    font-weight: 500;
}

.step-order-details {
    margin-top: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #ff5722;
}

.step-order-details h5 {
    margin: 0 0 10px 0;
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
}

.mini-items {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.mini-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.mini-image {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    object-fit: cover;
}

.mini-item span {
    font-size: 14px;
    color: #7f8c8d;
}

.order-items {
    margin-bottom: 30px;
}

.items-list {
    display: grid;
    gap: 15px;
}

.item-card {
    display: flex;
    gap: 15px;
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 10px;
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
}

.item-details {
    flex: 1;
}

.item-details h4 {
    margin: 0 0 5px 0;
}

.item-details p {
    margin: 0 0 10px 0;
    color: #7f8c8d;
    font-size: 14px;
}

.item-meta {
    display: flex;
    justify-content: space-between;
}

.delivery-details {
    margin-bottom: 30px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.info-item {
    display: flex;
    gap: 15px;
    align-items: flex-start;
}

.info-item i {
    color: #ff5722;
    font-size: 20px;
    margin-top: 2px;
}

.driver-info {
    margin-top: 20px;
}

.driver-card {
    display: flex;
    gap: 15px;
    align-items: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.driver-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}

.action-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
}

.btn-reorder,
.btn-support,
.btn-share {
    padding: 12px 24px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s;
}

.btn-reorder {
    background: #ff5722;
    color: white;
}

.btn-support {
    background: #3498db;
    color: white;
}

.btn-share {
    background: #2ecc71;
    color: white;
}

.recent-orders {
    margin-top: 40px;
}

.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.order-card {
    background: white;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s;
}

.order-card:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.order-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.order-number {
    font-weight: 600;
    color: #2c3e50;
}

.status {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
}

.loading-state {
    text-align: center;
    padding: 40px;
}

.spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #ff5722;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: 0 auto 20px;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@media (max-width: 768px) {
    .tracking-container {
        padding: 10px;
    }

    .search-form {
        flex-direction: column;
    }

    .order-input {
        width: 100%;
    }

    .order-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .progress-steps {
        flex-direction: column;
        gap: 20px;
    }

    .step:not(:last-child)::after {
        display: none;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .action-buttons {
        flex-direction: column;
    }
}
</style>
