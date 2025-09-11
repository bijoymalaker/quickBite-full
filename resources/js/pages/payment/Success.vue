<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'PaymentSuccess',
    components: {
        Layout
    },
    props: {
        orderDetails: {
            type: Object,
            default: null
        },
        error: {
            type: String,
            default: null
        }
    },
    mounted() {
        document.title = 'Payment Successful - QuickBite';
    }
};
</script>

<template>
    <Layout>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card text-center" style="border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <div class="card-body p-5">
                            <div class="success-icon mb-4" style="color: #28a745; font-size: 4rem;">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <h2 class="card-title text-success mb-3">Payment Successful!</h2>
                            <p class="card-text text-muted mb-4">
                                Your payment has been processed successfully. Your order is now being prepared.
                            </p>

                            <div v-if="error" class="alert alert-danger">
                                <p>{{ error }}</p>
                            </div>
                            <div v-else-if="orderDetails" class="alert alert-info">
                                <h5>Order Details</h5>
                                <p><strong>Transaction ID:</strong> {{ orderDetails.transaction_id }}</p>
                                <p><strong>Amount:</strong> {{ orderDetails.amount }} {{ orderDetails.currency }}</p>
                                <p><strong>Status:</strong> {{ orderDetails.status }}</p>
                            </div>
                            <div v-else class="alert alert-warning">
                                <p>No order details available. Please contact support if you believe this is an error.</p>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="/" class="btn btn-primary me-md-2">
                                    <i class="bi bi-house-door"></i> Back to Home
                                </a>
                                <a href="/tracking" class="btn btn-outline-primary">
                                    <i class="bi bi-geo-alt"></i> Track Order
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style scoped>
.success-icon {
    color: #28a745;
    font-size: 4rem;
}
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
