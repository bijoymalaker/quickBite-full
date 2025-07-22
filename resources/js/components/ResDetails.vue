<template>
  <div class="container my-4">
    <div class="card shadow">
      <div class="row">
        <!-- Delivery Information -->
        <div class="col-md-4 p-3 ps-5">
          <h5 class="fw-bold"><i class="bi bi-truck"></i> Delivery information</h5>
          <ul class="list-unstyled">
            <li v-for="(time, day) in deliveryTimes" :key="day">
              <strong>{{ day }}:</strong> {{ time }}
            </li>
          </ul>
          <p class="fw-bold">Estimated time until delivery: <span class="text-primary">20 min</span></p>
        </div>

        <!-- Contact Information -->
        <div class="col-md-4 border-start border-end p-3 ps-5">
          <h5 class="fw-bold"><i class="bi bi-telephone"></i> <u>Contact information</u></h5>
          <p>
            If you have allergies or other dietary restrictions, please contact the restaurant. The restaurant will
            provide food-specific information upon request.
          </p>
          <p><strong>Phone number:</strong> +934443-43</p>
          <p>
            <strong>Website:</strong>
            <a href="http://mcdonalds.uk/" target="_blank">http://mcdonalds.uk/</a>
          </p>
        </div>

        <!-- Operational Times -->
        <div class="col-md-4 bg-dark text-white p-3 rounded-end">
          <h5 class="fw-bold"><i class="bi bi-clock"></i> Operational Times</h5>
          <ul class="list-unstyled">
            <li v-for="(time, day) in operationalTimes" :key="day">
              <strong>{{ day }}:</strong> {{ time }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ResDetails",
  data() {
    return {
      deliveryTimes: {
        Monday: "12:00 AM–3:00 AM, 8:00 AM–3:00 AM",
        Tuesday: "8:00 AM–3:00 AM",
        Wednesday: "8:00 AM–3:00 AM",
        Thursday: "8:00 AM–3:00 AM",
        Friday: "8:00 AM–3:00 AM",
        Saturday: "8:00 AM–3:00 AM",
        Sunday: "8:00 AM–12:00 AM",
      },
      operationalTimes: {
        Monday: "8:00 AM–3:00 AM",
        Tuesday: "8:00 AM–3:00 AM",
        Wednesday: "8:00 AM–3:00 AM",
        Thursday: "8:00 AM–3:00 AM",
        Friday: "8:00 AM–3:00 AM",
        Saturday: "8:00 AM–3:00 AM",
        Sunday: "8:00 AM–3:00 AM",
      },
    };
  },
};
</script>

<style scoped>
.card {
  border-radius: 10px;
}
.bg-dark {
  background-color: #0a0a0a !important;
}
a {
  color: #007bff;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}
</style>