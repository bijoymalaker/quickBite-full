<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'PaymentFail',
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
        document.title = 'Payment Failed - QuickBite';
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
                            <div class="fail-icon mb-4" style="color: #dc3545; font-size: 4rem;">
                                <i class="bi bi-x-circle-fill"></i>
                            </div>
                            <h2 class="card-title text-danger mb-3">Payment Failed</h2>
                            <p class="card-text text-muted mb-4">
                                Unfortunately, your payment could not be processed. Please try again or contact support if the problem persists.
                            </p>

                            <div v-if="orderDetails" class="alert alert-warning">
                                <h5>Order Details</h5>
                                <p><strong>Transaction ID:</strong> {{ orderDetails.transaction_id }}</p>
                                <p><strong>Amount:</strong> {{ orderDetails.amount }} {{ orderDetails.currency }}</p>
                                <p><strong>Status:</strong> {{ orderDetails.status }}</p>
                            </div>
                            <div v-else-if="error" class="alert alert-danger">
                                <p>{{ error }}</p>
                            </div>
                            <div v-else class="alert alert-info">
                                <p>Payment failed. No additional details available.</p>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="/checkout" class="btn btn-primary me-md-2">
                                    <i class="bi bi-arrow-repeat"></i> Try Again
                                </a>
                                <a href="/" class="btn btn-outline-secondary">
                                    <i class="bi bi-house-door"></i> Back to Home
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
.fail-icon {
    color: #dc3545;
    font-size: 4rem;
}
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
