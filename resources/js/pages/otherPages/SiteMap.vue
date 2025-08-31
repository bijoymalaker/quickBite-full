<template>
    <Layout>
        <div class="container my-5">
            <h1 class="text-center mb-4">Site Map</h1>
            <div class="content">
                <p>Navigate through our website using the links below:</p>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/menus">Menus</a></li>
                    <li><a href="/restaurants">Restaurants</a></li>
                    <li><a href="/offers">Offers</a></li>
                    <li><a href="/checkout">Checkout</a></li>
                    <li><a href="/tracking">Tracking</a></li>
                    <li><a href="/dashboard">Dashboard</a></li>
                    <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                    <li><a href="/privacy-policy">Privacy Policy</a></li>
                    <li><a href="/contact-us">Contact Us</a></li>
                    <li><a href="/cookies">Cookies</a></li>
                </ul>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'SiteMap',
    components: {
        Layout,
    },
    mounted() {
        document.title = 'Site Map - QuickBite';
    },
};
</script>

<style scoped>
.content {
    max-width: 800px;
    margin: 0 auto;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin: 0.5rem 0;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>
