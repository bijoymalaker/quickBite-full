<template>
    <Layout>
        <div class="container my-5">
            <h1 class="text-center mb-4">Corporate Documents</h1>
            <div class="content">
                <p>Access our corporate documents and legal filings below:</p>
                <ul>
                    <li><a href="#" target="_blank">Annual Report 2023</a></li>
                    <li><a href="#" target="_blank">Financial Statements</a></li>
                    <li><a href="#" target="_blank">Corporate Governance Policy</a></li>
                    <li><a href="#" target="_blank">Sustainability Report</a></li>
                    <li><a href="#" target="_blank">Code of Conduct</a></li>
                </ul>
                <p>For more information or to request additional documents, please contact our corporate affairs team.</p>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'CorporateDocuments',
    components: {
        Layout,
    },
    mounted() {
        document.title = 'Corporate Documents - QuickBite';
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
