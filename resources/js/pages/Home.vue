<script>
// Restaurants name and image
import Rectangle7 from '../assets/imgs/Rectangle7.png';
import Rectangle8 from '../assets/imgs/Rectangle8.png';
import Rectangle9 from '../assets/imgs/Rectangle9.png';

// Components
import Layout from '@/layout/Layout.vue';
import AboutUs from '../components/AboutUs.vue';
import Add from '../components/Add.vue';
import Categories from '../components/Categories.vue';
import CountDown from '../components/CountDown.vue';
import ResCaro from '../components/ResCaro.vue';
export default {
    name: 'Home',
    data() {
        return {
            foodName: ['Vegan', 'Sushi', 'Pizza & Fast food', 'Others'],
            resName: [
                {
                    name: 'Chef Burgers London',
                    discount: '-40%',
                    img: Rectangle7,
                },
                {
                    name: 'Grand Ai Cafe London',
                    discount: '-20%',
                    img: Rectangle9,
                },
                {
                    name: 'Butterbrot Cafe London',
                    discount: '-17%',
                    img: Rectangle8,
                },
            ],
        };
    },
    components: {
        Layout,
        Categories,
        ResCaro,
        Add,
        AboutUs,
        CountDown,
    },
};
</script>

<template>
    <title>Home - Pretty Picks</title>
    <Layout>
        <div>
            <!-- Top banner part start  -->
            <section>
                <div class="container my-5">
                    <div class="row banner align-items-center">
                        <!-- Text and Search Section -->
                        <div class="col-lg-6 text-lg-start mb-lg-0 mb-4 text-center">
                            <p>Order Restaurant food, takeaway and groceries.</p>
                            <h1>
                                Feast Your Senses, <br />
                                <span>Fast and Fresh</span>
                            </h1>
                            <p>Enter a postcode to see what we deliver</p>
                            <div class="input-group search-input mb-3">
                                <input type="text" class="form-control" placeholder="e.g. EC4R 3TE" />
                                <button class="btn btn-warning text-white">Search</button>
                            </div>
                        </div>

                        <!-- Image and Notifications Section -->
                        <div class="col-lg-6 position-relative">
                            <img src="../assets/imgs/banner-img-1.png" alt="Eating Pizza" class="position-absolute banner-first-img" />

                            <!-- Notification Box -->
                            <div class="notification-box orange-bg">
                                <img src="../assets/imgs/banner-img.jpg" alt="Eating Pizza" class="responsive-image position-absolute mb-4" />
                                <div class="notification" data-step="1">
                                    <strong>Order</strong><br />
                                    We've received your order. Awaiting Restaurant acceptance.
                                </div>
                                <div class="notification" data-step="2">
                                    <strong>Order Accepted!</strong><br />
                                    Your order will be delivered shortly.
                                </div>
                                <div class="notification" data-step="3">
                                    <strong>Order</strong><br />
                                    Your rider's nearby! They're almost there - get ready!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container my-5">
                    <!-- Header Section -->
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-4">
                            <h2 class="deals-header">Up to -40% 🍔 QuickBite exclusive deals</h2>
                            <!-- Category Filter -->
                            <div class="category-filter d-none d-md-flex">
                                <a v-for="item in foodName" :key="item" href="#" class=""> {{ item }}</a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <!-- Dropdown for mobile devices -->
                            <div class="category-filter d-flex d-md-none">
                                <select class="form-select">
                                    <option v-for="item in foodName" :key="item">{{ item }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deals Cards -->
                <div class="row g-4">
                    <!-- Card 1 -->
                    <div class="col-md-4" v-for="item in resName" :key="item.name">
                        <div class="card deal-card">
                            <div class="position-relative">
                                <img v-bind:src="item.img" class="card-img-top" :alt="item.name" />
                                <span class="deals-card-overlay"></span>
                                <span class="discount-badge">{{ item.discount }}</span>
                            </div>
                            <div class="card-body">
                                <p class="mb-1 text-muted">Restaurant</p>
                                <p class="restaurant-name">{{ item.name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <Categories />
            <ResCaro />
            <Add />
            <AboutUs />
            <CountDown />
        </div>
    </Layout>
</template>

<style scoped></style>
