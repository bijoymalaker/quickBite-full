<template>
    <Layout>
        <div class="container my-5">
            <h1 class="text-center mb-4">Terms & Conditions</h1>
            <div class="content">
                <p>Welcome to QuickBite. These terms and conditions outline the rules and regulations for the use of our website and services.</p>
                <h3>1. Acceptance of Terms</h3>
                <p>By accessing this website, you accept these terms and conditions in full. If you disagree with any part of these terms, you must not use our website.</p>
                <h3>2. Use of Service</h3>
                <p>You agree to use our service only for lawful purposes and in a way that does not infringe the rights of others.</p>
                <h3>3. Ordering and Payment</h3>
                <p>All orders are subject to acceptance and availability. Payment must be made in full at the time of ordering.</p>
                <h3>4. Delivery</h3>
                <p>We strive to deliver your order within the estimated time, but delays may occur due to unforeseen circumstances.</p>
                <h3>5. Contact Information</h3>
                <p>If you have any questions about these terms, please contact us.</p>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'TermsAndConditions',
    components: {
        Layout,
    },
    mounted() {
        document.title = 'Terms & Conditions - QuickBite';
    },
};
</script>

<style scoped>
.content {
    max-width: 800px;
    margin: 0 auto;
}

h3 {
    margin-top: 2rem;
    color: #333;
}
</style>
