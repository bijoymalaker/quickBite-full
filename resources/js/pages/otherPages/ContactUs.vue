<template>
    <Layout>
        <div class="container my-5">
            <h1 class="text-center mb-4">Contact Us</h1>
            <div class="content">
                <p>We'd love to hear from you! Reach out to us with any questions or feedback.</p>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Get in Touch</h3>
                        <p><strong>Email:</strong> support@quickbite.com</p>
                        <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                        <p><strong>Address:</strong> 123 Food Street, London, UK</p>
                    </div>
                    <div class="col-md-6">
                        <h3>Send us a Message</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/layout/Layout.vue';

export default {
    name: 'ContactUs',
    components: {
        Layout,
    },
    mounted() {
        document.title = 'Contact Us - QuickBite';
    },
};
</script>

<style scoped>
.content {
    max-width: 1000px;
    margin: 0 auto;
}

h3 {
    margin-top: 2rem;
    color: #333;
}
</style>
