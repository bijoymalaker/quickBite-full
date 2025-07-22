<template>
    <div>
        <section class="stats-banner mt-5">
        <div class="container">
            <div class="row">
                <div class="col stats-item" v-for="stat in stats" :key="stat.label">
                    <h2 :class=" {'animate': isAnimating}" class="stats-number">{{ stat.animatedValue }}+</h2>
                    <h4 class="stats-label">{{ stat.label }}</h4>
                </div>
            </div>
        </div>
    </section>
        
    </div>
</template>
<script>
import { ref, onMounted } from "vue";
export default {
  setup() {
    const stats = ref([
      { label: "Registered Riders", value: 546, animatedValue: 0 },
      { label: "Orders Delivered", value: 789000, animatedValue: 0 },
      { label: "Restaurants Partnered", value: 690, animatedValue: 0 },
      { label: "Food Items", value: 17457, animatedValue: 0 },
    ]);

    const isAnimating = ref(false);

    const animateNumbers = () => {
      isAnimating.value = true;
      stats.value.forEach((stat) => {
        let start = 0;
        const end = stat.value;
        const duration = 2000; // 2 seconds
        const increment = Math.ceil(end / (duration / 16)); // Estimate frame rate
        
        const interval = setInterval(() => {
          start += increment;
          if (start >= end) {
            start = end;
            clearInterval(interval);
          }
          stat.animatedValue = start;
        }, 16);
      });
    };

    onMounted(() => {
      animateNumbers();
    });

    return { stats, isAnimating };
  },
};

</script>
<style scoped>

    
</style>