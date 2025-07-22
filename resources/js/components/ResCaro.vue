<template>
    <div>
        <section>
        <div class="container my-5">
            <!-- Header Section -->
            <h2 class="category-header mb-4">Popular Restaurants</h2>

            <!-- Categories Row -->
            <div class="row g-4">
                <!-- Category Card 1 -->
                <div class="col-md-2" v-for="restaurant in restaurants" :key="restaurant.name">
                    <div class="card category-card">
                        <img :src="restaurant.img" :alt="restaurant.name">
                        <div class="card-body text-center pp-res">
                            <p class="category-name text-white">{{ restaurant.name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    </div>
</template>
<script>

    import Rectangle13 from "../assets/imgs/resturents/Rectangle13.png";
    import Rectangle131 from "../assets/imgs/resturents/Rectangle131.png";
    import Rectangle132 from "../assets/imgs/resturents/Rectangle132.png";
    import Rectangle133 from "../assets/imgs/resturents/Rectangle133.png";
    import Rectangle134 from "../assets/imgs/resturents/Rectangle134.png";
    import Rectangle135 from "../assets/imgs/resturents/Rectangle135.png";


export default {
    name: "ResCaro",
    components: {

    },
    data() {
        return {
            restaurants: [
                {
                    name: 'McDonald’s London',
                    img: Rectangle13,
                },
                {
                    name: 'Salads',
                    img: Rectangle131,
                },
                {
                    name: 'Pasta & Casuals',
                    img: Rectangle132,
                },
                {
                    name: 'Pizza',
                    img: Rectangle133,
                },
                {
                    name: 'Breakfast',
                    img: Rectangle134,
                },
                {
                    name: 'Soups',
                    img: Rectangle135,
                },
            ]
        }
    },
    
}
</script>
<style>
    
</style>