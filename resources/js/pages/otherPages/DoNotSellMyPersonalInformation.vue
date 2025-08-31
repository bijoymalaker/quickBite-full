<template>
    <Layout>
        <div class="container my-5">
            <h1 class="text-center mb-4">Do Not Sell My Personal Information</h1>
            <div class="content">
                <p>Under the California Consumer Privacy Act (CCPA), you have the right to opt out of the sale of your personal information.</p>
                <h3>1. Your Rights</h3>
                <p>You have the right to request that we do not sell your personal information to third parties.</p>
                <h3>2. How to Opt Out</h3>
                <p>To exercise this right, please contact us using the information provided below. We will process your request within 45 days.</p>
                <h3>3. Contact Information</h3>
                <p><strong>Email:</strong> privacy@quickbite.com</p>
                <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                <p><strong>Mailing Address:</strong> 123 Food Street, London, UK</p>
                <h3>4. Additional Information</h3>
                <p>For more details about your privacy rights, please refer to our Privacy Policy.</p>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'DoNotSellMyPersonalInformation',
    components: {
        Layout,
    },
    mounted() {
        document.title = 'Do Not Sell My Personal Information - QuickBite';
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
