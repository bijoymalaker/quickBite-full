<template>
  <Layout>
    <div class="container my-5">
        <header class="login-header">
            <img src="https://cdn-icons-png.flaticon.com/512/3448/3448636.png" 
                 alt="Restaurant Login" class="login-avatar">
        </header>
        <div class="login-login">
            <h3 class="text-center mb-4">Restaurant Owner Login</h3>
            <form @submit.prevent="submit">
                <label for="email">Email</label>
                <input id="email" type="email" v-model="form.email" required>
                <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>
                
                <label for="password">Password</label>
                <input id="password" type="password" v-model="form.password" required>
                <div v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</div>
                
                <button class="login-btn" type="submit" :disabled="form.processing">Login as Restaurant</button>
            </form>
            <div class="login-footer">
                <a href="#" @click.prevent="goToForgotPassword">Forgot your Password?</a>
            </div>
            <div class="text-center mt-3">
                <p>Don't have a restaurant account? 
                  <a href="#" @click.prevent="goToRestaurantRegister" class="text-primary">Register your restaurant</a>
                </p>
            </div>
        </div>
    </div>
  </Layout>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Layout from '@/layout/Layout.vue';
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue';

onMounted(() => {
    document.title = 'Restaurant Login - QuickBite';
});

const form = useForm({
    email: '',
    password: '',
    role: 'restaurant', // Always set role to restaurant for restaurant login
});

const submit = () => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
};

const goToForgotPassword = () => {
    router.get('/forgot-password');
};

const goToRestaurantRegister = () => {
    // This will be implemented later for restaurant registration
    router.get('/register');
};
</script>

<style scoped>
.container {
  position: relative;
  width: 400px;
  min-height: 500px;
  margin: 0 auto;
  background: white;
  box-shadow: 0px 0px 8px 0px #aaa;
  border-radius: 10px;
}

.login-header {
  position: absolute;
  top: 0;
  left: 0;
  height: 100px;
  width: 100%;
  border-bottom: 1px solid #C9C5C5; 
  background: #fff;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

.login-avatar {
  position: absolute;
  top: 0;
  left: 50%;
  margin-left: -40px;
  width: 80px;
  height: 100%;
  padding: 10px 0;
}

.login-login {
  position: absolute;
  top: 100px;
  width: 100%;
  height: 400px;
  padding: 20px 30px;
}

.login-login label, .login-login input {
  display: inline-block;
  width: 100%;
}

.login-login input {
  height: 40px;
  font-size: medium;
  padding: 0 8px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.login-login label {
  margin-top: 14px;
  font-weight: 500;
}

.login-footer {
  text-align: center;
  margin: 10px 0;
}

.login-footer a {
  color: #007bff;
  text-decoration: none;
}

.login-footer a:hover {
  text-decoration: underline;
}

.login-login button {
  width: 100%;
  height: 40px;
  margin-top: 20px;
  border: 0;
  border-radius: 5px;
  color: white;
  font-size: medium;
  transition: all .3s ease;
  background: #28a745;
}

.login-login button:hover {
  opacity: .8;
  cursor: pointer;
}

.login-login button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.text-danger {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}

.text-primary {
  color: #007bff;
  text-decoration: none;
}

.text-primary:hover {
  text-decoration: underline;
}
</style>
