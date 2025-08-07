<template>
  <title>Forgot Password - Pretty Picks</title>
  <Layout>
    <div class="container my-5">
        <header class="login-header">
            <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-3/177800/130-512.png"
                alt="" class="login-avatar">
        </header>
        <div class="login-login">
            <form @submit.prevent="submit">
                <label for="email">Email</label>
                <input id="email" type="email" v-model="form.email" required>
                <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>
                
                <div v-if="status" class="text-success">{{ status }}</div>
                
                <button class="login-btn" type="submit" :disabled="form.processing">Send Password Reset Link</button>
            </form>
            <form action="">
                <button class="signup-btn" type="button" @click="goToLogin">Back to Login</button>
            </form>
        </div>
        <footer class="login-footer">
            <a href="">Remember your password?</a>
        </footer>
    </div>
  </Layout>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Layout from '@/layout/Layout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post('/forgot-password', {
        onFinish: () => form.reset('email'),
    });
};

const goToLogin = () => {
    router.get('/login');
};
</script>

<style scoped>
.container {
  position: relative;
  width: 350px;
  min-height: 470px;
  margin: 0 auto;
  background: white;
  box-shadow: 0px 0px 8px 0px #aaa;
}

.login-header {
  position: absolute;
  top: 0;
  left: 0;
  height: 100px;
  width: 100%;
  border-bottom: 1px solid #C9C5C5; 
  background: #fff;
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
  height: 250px;
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
}

.login-login label {
  margin-top: 14px;
}

.login-footer {
  position: absolute;
  width: 100%;
  line-height: 40px;
  bottom: 0;
  border-top: 1px solid #C9C5C5;
  background: #EAE5E5;
  text-align: center;
  font-size: small;
}

.login-footer a {
  color: black;
}

.login-login button {
  width: 100%;
  height: 40px;
  margin-top: 20px;
  border: 0;
  border-radius: 2px;
  color: white;
  font-size: medium;
  transition: all .3s ease;
}

.login-login button:hover {
  opacity: .8;
  cursor: pointer;
}

.login-login button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.login-btn {
  background: #4CAF50;
}

.signup-btn {
  background: #2196F3;
}

.text-danger {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}

.text-success {
  color: green;
  text-align: center;
  padding-top: 10px;
}
</style>