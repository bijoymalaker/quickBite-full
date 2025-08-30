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
            <div class="search-section">
                <div class="search-card">
                    <h3>Find Your Order</h3>
                    <div class="search-form">
                        <input 
                            v-model="orderNumber" 
                            type="text" 
                            placeholder="Enter Order Number (e.g., QB2024001)"
                            class="order-input"
                            @keyup.enter="trackOrder"
                        />
                        <button @click="trackOrder" class="track-btn" :disabled="!orderNumber">
                            <i class="fas fa-search"></i> Track Order
                        </button>
                    </div>
                    <p v-if="searchError" class="error-message">{{ searchError }}</p>
                </div>
            </div>

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
                            <strong>৳{{ currentOrder.totalAmount.toFixed(2) }}</strong>
                        </div>
                        <div class="summary-item">
                            <span>Estimated Delivery:</span>
                            <strong>{{ formatDate(currentOrder.estimatedDelivery) }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Progress Tracker -->
                <div class="progress-tracker">
                    <h3>Order Progress</h3>
                    <div class="progress-steps">
                        <div 
                            v-for="(step, index) in progressSteps" 
                            :key="index"
                            :class="['step', { active: isStepActive(step), completed: isStepCompleted(step) }]"
                        >
                            <div class="step-icon">
                                <i :class="step.icon"></i>
                            </div>
                            <div class="step-content">
                                <h4>{{ step.title }}</h4>
                                <p>{{ step.description }}</p>
                                <span v-if="step.timestamp" class="step-time">{{ formatTime(step.timestamp) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="order-items">
                    <h3>Order Items</h3>
                    <div class="items-list">
                        <div v-for="item in currentOrder.items" :key="item.id" class="item-card">
                            <img :src="item.image || '/placeholder-food.jpg'" :alt="item.name" class="item-image">
                            <div class="item-details">
                                <h4>{{ item.name }}</h4>
                                <p>{{ item.description }}</p>
                                <div class="item-meta">
                                    <span class="quantity">Qty: {{ item.quantity }}</span>
                                    <span class="price">৳{{ item.price.toFixed(2) }}</span>
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
                            <img :src="currentOrder.driver.avatar || '/driver-avatar.jpg'" alt="Driver" class="driver-avatar">
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
                    <button @click="reorder" class="btn-reorder">
                        <i class="fas fa-redo"></i> Reorder
                    </button>
                    <button @click="contactSupport" class="btn-support">
                        <i class="fas fa-headset"></i> Contact Support
                    </button>
                    <button @click="shareOrder" class="btn-share">
                        <i class="fas fa-share"></i> Share Order
                    </button>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div v-if="recentOrders.length > 0" class="recent-orders">
                <h3>Recent Orders</h3>
                <div class="orders-grid">
                    <div 
                        v-for="order in recentOrders" 
                        :key="order.orderNumber"
                        class="order-card"
                        @click="selectOrder(order.orderNumber)"
                    >
                        <div class="order-card-header">
                            <span class="order-number">#{{ order.orderNumber }}</span>
                            <span :class="['status', order.status.toLowerCase()]">{{ order.status }}</span>
                        </div>
                        <div class="order-card-body">
                            <p>{{ order.items.length }} items • ৳{{ order.totalAmount.toFixed(2) }}</p>
                            <p class="order-date">{{ formatDate(order.orderDate) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div v-if="isLoading" class="loading-state">
                <div class="spinner"></div>
                <p>Tracking your order...</p>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: "Tracking",
    components: {
        Layout
    },
    data() {
        return {
            orderNumber: '',
            currentOrder: null,
            searchError: '',
            isLoading: false,
            recentOrders: [],
            mockOrders: [
                {
                    orderNumber: 'QB2024001',
                    orderDate: new Date('2024-01-15T14:30:00'),
                    estimatedDelivery: new Date('2024-01-15T15:45:00'),
                    status: 'Out for Delivery',
                    totalAmount: 45.99,
                    customerName: 'John Doe',
                    customerPhone: '+1 (555) 123-4567',
                    deliveryAddress: '123 Main St, Apt 4B, New York, NY 10001',
                    deliveryMethod: 'Home Delivery',
                    driver: {
                        name: 'Mike Johnson',
                        phone: '+1 (555) 987-6543',
                        vehicle: 'Honda Civic - ABC123',
                        rating: 4.8,
                        avatar: '/driver-mike.jpg'
                    },
                    items: [
                        {
                            id: 1,
                            name: 'Margherita Pizza',
                            description: 'Fresh mozzarella, tomato sauce, basil',
                            price: 18.99,
                            quantity: 1,
                            image: '/pizza-margherita.jpg'
                        },
                        {
                            id: 2,
                            name: 'Caesar Salad',
                            description: 'Romaine lettuce, parmesan, croutons',
                            price: 12.00,
                            quantity: 1,
                            image: '/caesar-salad.jpg'
                        },
                        {
                            id: 3,
                            name: 'Garlic Bread',
                            description: 'Freshly baked with garlic butter',
                            price: 8.00,
                            quantity: 2,
                            image: '/garlic-bread.jpg'
                        }
                    ],
                    progress: [
                        { step: 'order-placed', timestamp: new Date('2024-01-15T14:30:00') },
                        { step: 'confirmed', timestamp: new Date('2024-01-15T14:35:00') },
                        { step: 'preparing', timestamp: new Date('2024-01-15T14:45:00') },
                        { step: 'out-for-delivery', timestamp: new Date('2024-01-15T15:15:00') }
                    ]
                },
                {
                    orderNumber: 'QB2024002',
                    orderDate: new Date('2024-01-14T19:00:00'),
                    estimatedDelivery: new Date('2024-01-14T19:30:00'),
                    status: 'Delivered',
                    totalAmount: 32.50,
                    customerName: 'Jane Smith',
                    customerPhone: '+1 (555) 987-1234',
                    deliveryAddress: '456 Oak Ave, Brooklyn, NY 11201',
                    deliveryMethod: 'Home Delivery',
                    driver: null,
                    items: [
                        {
                            id: 4,
                            name: 'Chicken Burger',
                            description: 'Grilled chicken, lettuce, tomato, mayo',
                            price: 15.50,
                            quantity: 1,
                            image: '/chicken-burger.jpg'
                        },
                        {
                            id: 5,
                            name: 'French Fries',
                            description: 'Crispy golden fries',
                            price: 5.00,
                            quantity: 2,
                            image: '/french-fries.jpg'
                        }
                    ],
                    progress: [
                        { step: 'order-placed', timestamp: new Date('2024-01-14T19:00:00') },
                        { step: 'confirmed', timestamp: new Date('2024-01-14T19:05:00') },
                        { step: 'preparing', timestamp: new Date('2024-01-14T19:10:00') },
                        { step: 'out-for-delivery', timestamp: new Date('2024-01-14T19:25:00') },
                        { step: 'delivered', timestamp: new Date('2024-01-14T19:30:00') }
                    ]
                }
            ]
        }
    },
    computed: {
        progressSteps() {
            return [
                {
                    key: 'order-placed',
                    title: 'Order Placed',
                    description: 'We have received your order',
                    icon: 'fas fa-clipboard-check',
                    timestamp: this.getProgressTimestamp('order-placed')
                },
                {
                    key: 'confirmed',
                    title: 'Order Confirmed',
                    description: 'Restaurant has accepted your order',
                    icon: 'fas fa-check-circle',
                    timestamp: this.getProgressTimestamp('confirmed')
                },
                {
                    key: 'preparing',
                    title: 'Preparing',
                    description: 'Your food is being prepared',
                    icon: 'fas fa-utensils',
                    timestamp: this.getProgressTimestamp('preparing')
                },
                {
                    key: 'out-for-delivery',
                    title: 'Out for Delivery',
                    description: 'Your order is on its way',
                    icon: 'fas fa-motorcycle',
                    timestamp: this.getProgressTimestamp('out-for-delivery')
                },
                {
                    key: 'delivered',
                    title: 'Delivered',
                    description: 'Order delivered successfully',
                    icon: 'fas fa-home',
                    timestamp: this.getProgressTimestamp('delivered')
                }
            ];
        }
    },
    mounted() {
        // Load recent orders
        this.recentOrders = this.mockOrders.slice(0, 2);
        
        // Check if order number is provided in URL
        const urlParams = new URLSearchParams(window.location.search);
        const orderNum = urlParams.get('order');
        if (orderNum) {
            this.orderNumber = orderNum;
            this.trackOrder();
        }
    },
    methods: {
        trackOrder() {
            if (!this.orderNumber.trim()) {
                this.searchError = 'Please enter an order number';
                return;
            }

            this.isLoading = true;
            this.searchError = '';

            // Simulate API call
            setTimeout(() => {
                const order = this.mockOrders.find(o => o.orderNumber === this.orderNumber.trim());
                if (order) {
                    this.currentOrder = order;
                    this.searchError = '';
                } else {
                    this.searchError = 'Order not found. Please check your order number.';
                    this.currentOrder = null;
                }
                this.isLoading = false;
            }, 1000);
        },
        selectOrder(orderNumber) {
            this.orderNumber = orderNumber;
            this.trackOrder();
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        },
        formatTime(date) {
            return new Date(date).toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });
        },
        getProgressTimestamp(step) {
            if (!this.currentOrder || !this.currentOrder.progress) return null;
            const progress = this.currentOrder.progress.find(p => p.step === step);
            return progress ? progress.timestamp : null;
        },
        isStepActive(step) {
            const timestamp = this.getProgressTimestamp(step.key);
            return timestamp !== null;
        },
        isStepCompleted(step) {
            const currentStepIndex = this.progressSteps.findIndex(s => s.key === step.key);
            const lastCompletedIndex = this.currentOrder?.progress?.length - 1 || 0;
            return currentStepIndex <= lastCompletedIndex;
        },
        reorder() {
            alert('Reordering functionality would be implemented here');
        },
        contactSupport() {
            alert('Contact support functionality would be implemented here');
        },
        shareOrder() {
            if (this.currentOrder) {
                const shareText = `Check out my order #${this.currentOrder.orderNumber} from QuickBite!`;
                if (navigator.share) {
                    navigator.share({
                        title: 'QuickBite Order',
                        text: shareText,
                        url: window.location.href + '?order=' + this.currentOrder.orderNumber
                    });
                } else {
                    alert(shareText);
                }
            }
        }
    }
}
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
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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

.progress-tracker {
    margin-bottom: 30px;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.step {
    flex: 1;
    text-align: center;
    position: relative;
}

.step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 25px;
    left: 50%;
    width: 100%;
    height: 2px;
    background: #e0e0e0;
    z-index: 1;
}

.step.active .step-icon,
.step.completed .step-icon {
    background: #ff5722;
    color: white;
}

.step.completed:not(:last-child)::after {
    background: #ff5722;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    position: relative;
    z-index: 2;
}

.step-content h4 {
    margin: 0 0 5px 0;
    font-size: 14px;
}

.step-content p {
    margin: 0;
    font-size: 12px;
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

.btn-reorder, .btn-support, .btn-share {
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
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
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
