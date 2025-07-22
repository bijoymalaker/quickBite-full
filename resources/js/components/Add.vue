<template>
    <div>
        <section>
        <div class="container my-5">
            <div class="row g-4">
                <!-- Partner with Us Card -->
                <div class="col-md-6" v-for="add in addDetails" :key="add.title">
                    <div class="promo-card position-relative">
                        <img :src="add.img" :alt="add.title" class="promo-img">
                        <span class="promo-badge">{{ add.badge }}</span>
                        <div class="promo-content">
                            <p>Signup as a business</p>
                            <h3>{{ add.title }}</h3>
                            <button class="promo-button">{{ add.button }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</template>
<script>

import Rectangle81 from "../assets/imgs/partner/Rectangle81.png";
import Rectangle8 from "../assets/imgs/partner/Rectangle8.png";

export default {
    name: "Add",
    data() {
        return {
            addDetails: [
                {
                    img: Rectangle81,
                    badge: "Earn more with lower fees",
                    title: "Partner with us",
                    button: "Get Started"
                },
                {
                    img: Rectangle8,
                    badge: "Avail exclusive perks",
                    title: "Ride with us",
                    button: "Get Started"
                }
            ]
            
        };
    },
    components: {
        
    }
    
}
</script>
<style>
    
</style>