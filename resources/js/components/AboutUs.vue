<template>
    <div>
        <section>
            <div class="container">
                <div class="row service-header">
                    <div class="col-4">
                        <h2>Know more about us!</h2>
                    </div>
                    <!-- Navigation tabs -->
                    <div class="col-8">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item"><a class="nav-link" href="#">Frequent Questions</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Who are we?</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Partner Program</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Help & Support</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row align-items-center about-nav">
                    <div class="col-4">
                        <!-- Tab navs -->
                        <div class="nav flex-column nav-pills text-center nav-item list-group" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active list-group-item" id="v-pills-link1-tab" data-bs-toggle="pill"
                                href="#v-pills-link1" role="tab" aria-controls="v-pills-link1" aria-selected="true">Link
                                1</a>
                            <a class="nav-link list-group-item" id="v-pills-link2-tab" data-bs-toggle="pill" href="#v-pills-link2"
                                role="tab" aria-controls="v-pills-link2" aria-selected="false">Link 2</a>
                            <a class="nav-link list-group-item" id="v-pills-link3-tab" data-bs-toggle="pill" href="#v-pills-link3"
                                role="tab" aria-controls="v-pills-link3" aria-selected="false">Link 3</a>
                            <a class="nav-link list-group-item" id="v-pills-link4-tab" data-bs-toggle="pill" href="#v-pills-link4"
                                role="tab" aria-controls="v-pills-link4" aria-selected="false">Link 4</a>
                        </div>
                        <!-- Tab navs -->
                    </div>

                    <div class="col-8">
                        <!-- Tab content -->
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-link1" role="tabpanel"
                                aria-labelledby="v-pills-link1-tab">
                                <div class="row">
                                    <div class="col-md-4 service-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="service-icon">🔍</div>
                                                <h5 class="card-title">How does Order.UK work?</h5>
                                                <p class="card-text">Description of how the service works.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Place an Order! -->
                                    <div class="col-md-4 service-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="service-icon">🛒</div>
                                                <h5 class="card-title">Place an Order!</h5>
                                                <p class="card-text">Description of how to place an order.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Track Progress -->
                                    <div class="col-md-4 service-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="service-icon">📈</div>
                                                <h5 class="card-title">Track Progress</h5>
                                                <p class="card-text">Description of how to track progress.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center">Order.UK simplifies the food ordering process. Browse through our
                                    diverse
                                    menu, select your favorite dishes, and proceed to checkout. Your delicious meal will
                                    be on its
                                    way to your doorstep in no time!</p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-link2" role="tabpanel"
                                aria-labelledby="v-pills-link2-tab">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Est, excepturi illo neque eaque error corrupti laborum alias
                                veniam natus molestias in cupiditate magnam ratione voluptatem!
                            </div>
                            <div class="tab-pane fade" id="v-pills-link3" role="tabpanel"
                                aria-labelledby="v-pills-link3-tab">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Aspernatur, illum.
                            </div>
                            <div class="tab-pane fade" id="v-pills-link4" role="tabpanel"
                                aria-labelledby="v-pills-link4-tab">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Sequi quasi dicta qui porro eligendi nam doloribus vel minus ullam quam!
                            </div>
                        </div>
                        <!-- Tab content -->
                    </div>
                </div>


            </div>
        </section>
    </div>
</template>
<script>
export default {
    name: "AboutUs",
    data() {
        return {

        };
    },
    components: {

    }

}
</script>
<style scoped>
    .about-nav{
        height: 350px;
    }
</style>