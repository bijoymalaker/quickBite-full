<template>
    <Layout>
        <div class="container my-5">
            <h1 class="text-center mb-4">Modern Slavery Statement</h1>
            <div class="content">
                <p>QuickBite is committed to combating modern slavery and human trafficking in all its forms. This statement outlines our approach and actions.</p>
                <h3>1. Our Commitment</h3>
                <p>We are committed to ensuring that there is no modern slavery or human trafficking in our supply chains or in any part of our business.</p>
                <h3>2. Risk Assessment</h3>
                <p>We conduct regular risk assessments to identify potential areas where modern slavery might occur in our operations and supply chains.</p>
                <h3>3. Supplier Due Diligence</h3>
                <p>We require our suppliers to adhere to our ethical standards and conduct their own due diligence on modern slavery risks.</p>
                <h3>4. Training and Awareness</h3>
                <p>We provide training to our employees and suppliers to raise awareness about modern slavery and how to identify and report it.</p>
                <h3>5. Reporting</h3>
                <p>If you suspect modern slavery in our supply chain, please contact us immediately.</p>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'ModernSlaveryStatement',
    components: {
        Layout,
    },
    mounted() {
        document.title = 'Modern Slavery Statement - QuickBite';
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
