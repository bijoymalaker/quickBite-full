<template>
    <Layout>
        <div class="container my-5">
            <h1 class="text-center mb-4">Cookies Policy</h1>
            <div class="content">
                <p>This Cookies Policy explains how QuickBite uses cookies and similar technologies on our website.</p>
                <h3>1. What Are Cookies</h3>
                <p>Cookies are small text files that are stored on your device when you visit our website.</p>
                <h3>2. How We Use Cookies</h3>
                <p>We use cookies to improve your browsing experience, analyze site traffic, and personalize content.</p>
                <h3>3. Types of Cookies We Use</h3>
                <ul>
                    <li><strong>Essential Cookies:</strong> Necessary for the website to function properly.</li>
                    <li><strong>Analytics Cookies:</strong> Help us understand how visitors interact with our website.</li>
                    <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements.</li>
                </ul>
                <h3>4. Managing Cookies</h3>
                <p>You can control and manage cookies through your browser settings. However, disabling certain cookies may affect the functionality of our website.</p>
                <h3>5. Contact Us</h3>
                <p>If you have any questions about our use of cookies, please contact us.</p>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'Cookies',
    components: {
        Layout,
    },
    mounted() {
        document.title = 'Cookies - QuickBite';
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

ul {
    padding-left: 1.5rem;
}
</style>
