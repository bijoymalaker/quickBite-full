<template>
  <Layout>
    <div class="container my-5">
        <header class="login-header">
            <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-3/177800/130-512.png"
                alt="" class="login-avatar">
        </header>
        <div class="login-login">
            <form @submit.prevent="submit">
                <h3 class="text-center">Confirm Password</h3>
                <p class="text-center">This is a secure area of the application. Please confirm your password before continuing.</p>
                
                <label for="password">Password</label>
                <input id="password" type="password" v-model="form.password" required>
                <div v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</div>
                
                <button class="login-btn" type="submit" :disabled="form.processing">Confirm</button>
            </form>
        </div>
    </div>
  </Layout>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Layout from '@/layout/Layout.vue';
import { onMounted } from 'vue';

onMounted(() => {
    document.title = 'Confirm Password - QuickBite';
});

const form = useForm({
    password: '',
});

const submit = () => {
    form.post('/confirm-password', {
        onFinish: () => form.reset('password'),
    });
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

.login-login h3 {
  text-align: center;
  margin-bottom: 15px;
  color: #333;
}

.login-login p {
  text-align: center;
  margin-bottom: 20px;
  color: #666;
  font-size: 14px;
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

.text-danger {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}
</style>
