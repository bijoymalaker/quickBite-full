
<script>

// Restaurants name and image
import Rectangle8 from '../assets/imgs/Rectangle8.png'
import Rectangle7 from '../assets/imgs/Rectangle7.png'
import Rectangle9 from '../assets/imgs/Rectangle9.png'

// Components
import Categories from '../components/Categories.vue'
import ResCaro from '../components/ResCaro.vue'
import Add from '../components/Add.vue'
import AboutUs from '../components/AboutUs.vue'
import CountDown from '../components/CountDown.vue'
import Layout from '@/layout/Layout.vue'
export default {
    name: "Home",
    data() {
        return {
            foodName: ['Vegan', 'Sushi', 'Pizza & Fast food', 'Others'],
            resName: [{
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
            }],
        };
    },
    components: {
        Layout, Categories, ResCaro, Add, AboutUs, CountDown
    }
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
                    <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                        <p>Order Restaurant food, takeaway and groceries.</p>
                        <h1>Feast Your Senses, <br /> <span>Fast and Fresh</span></h1>
                        <p>Enter a postcode to see what we deliver</p>
                        <div class="input-group mb-3 search-input">
                            <input type="text" class="form-control" placeholder="e.g. EC4R 3TE">
                            <button class="btn btn-warning text-white">Search</button>
                        </div>
                    </div>

                    <!-- Image and Notifications Section -->
                    <div class="col-lg-6 position-relative">
                        <img src="../assets/imgs/banner-img-1.png" alt="Eating Pizza"
                            class="position-absolute banner-first-img" />

                        <!-- Notification Box -->
                        <div class="notification-box orange-bg">
                            <img src="../assets/imgs/banner-img.jpg" alt="Eating Pizza"
                                class="responsive-image mb-4 position-absolute">
                            <div class="notification" data-step="1">
                                <strong>Order</strong><br>
                                We've received your order. Awaiting Restaurant acceptance.
                            </div>
                            <div class="notification" data-step="2">
                                <strong>Order Accepted!</strong><br>
                                Your order will be delivered shortly.
                            </div>
                            <div class="notification" data-step="3">
                                <strong>Order</strong><br>
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="deals-header">Up to -40% 🍔 QuickBite exclusive deals</h2>
                    <!-- Category Filter -->
                    <div class="category-filter">
                        <a v-for="item in foodName" :key="item" href="#" class=""> {{ item }}</a>

                    </div>
                </div>

                <!-- Deals Cards -->
                <div class="row g-4">
                    <!-- Card 1 -->
                    <div class="col-md-4" v-for="item in resName" :key="item.name">
                        <div class="card deal-card">
                            <div class="position-relative">
                                <img v-bind:src="item.img" class="card-img-top" :alt="item.name">
                                <span class="deals-card-overlay"></span>
                                <span class="discount-badge">{{ item.discount }}</span>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-1">Restaurant</p>
                                <p class="restaurant-name">{{ item.name }}</p>
                            </div>
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