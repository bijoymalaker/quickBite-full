<template>
    <Layout>
        <div class="container my-5">
            <h1 class="text-center mb-4">Privacy Policy</h1>
            <div class="content">
                <p>At QuickBite, we are committed to protecting your privacy. This privacy policy explains how we collect, use, and safeguard your information.</p>
                <h3>1. Information We Collect</h3>
                <p>We collect information you provide directly to us, such as when you create an account, place an order, or contact us.</p>
                <h3>2. How We Use Your Information</h3>
                <p>We use the information to process orders, improve our services, and communicate with you about your account and orders.</p>
                <h3>3. Information Sharing</h3>
                <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.</p>
                <h3>4. Data Security</h3>
                <p>We implement appropriate security measures to protect your personal information against unauthorized access.</p>
                <h3>5. Your Rights</h3>
                <p>You have the right to access, update, or delete your personal information. Contact us to exercise these rights.</p>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'PrivacyPolicy',
    components: {
        Layout,
    },
    mounted() {
        document.title = 'Privacy Policy - QuickBite';
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
