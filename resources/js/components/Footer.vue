<template>
    <div>
        <footer class="footer mt-auto py-3 text-black">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3 mb-md-0">
                    <img src="../assets/imgs/quickbiteLogo.webp" alt="" srcset="" class="img-fluid mb-2">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h5>Get Exclusive Deals in Your Inbox</h5>
                    <input type="email" placeholder="your@email.com" aria-label="Email Address" />
                    <button type="submit">Subscribe</button>
                </div>
                <div class="col-md-2 mb-3 mb-md-0">
                    <h5>Legal Pages</h5>
                    <Link :href="route('terms-and-conditions')">Terms & Conditions</Link><br>
                    <Link :href="route('privacy-policy')">Privacy Policy</Link>
                </div>
                <div class="col-md-2 mb-3 mb-md-0">
                    <h5>Important Links</h5>
                    <Link :href="route('site-map')">Site Map</Link><br>
                    <Link :href="route('contact-us')">Contact Us</Link><br>
                    <Link :href="route('cookies')">Cookies</Link><br>
                    <Link :href="route('modern-slavery-statement')">Modern Slavery Statement</Link><br>
                    <Link :href="route('corporate-documents')">Corporate Documents</Link>
                </div>
                <div class="col-md-2">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="#"><font-awesome-icon icon="fa-brands fa-facebook-f" /></a>
                        <a href="#"><font-awesome-icon icon="fa-brands fa-twitter" /></a>
                        <a href="#"><font-awesome-icon icon="fa-brands fa-instagram" /></a>
                        <a href="#"><font-awesome-icon icon="fa-brands fa-youtube" /></a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <p>Company © 2021-2025 - All Rights Reserved with House of Companies</p>
                    <Link :href="route('privacy-policy')">Privacy Policy</Link> | <Link :href="route('terms-and-conditions')">Terms</Link> | <Link :href="route('do-not-sell-my-personal-information')">Do not sell my personal information</Link>
                </div>
            </div>
        </div>
    </footer>
        
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
</script>
<style scoped>
    
</style>