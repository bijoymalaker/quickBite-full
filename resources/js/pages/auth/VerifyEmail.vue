<template>
  <Layout>
    <div class="container my-5">
        <header class="login-header">
            <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-3/177800/130-512.png"
                alt="" class="login-avatar">
        </header>
        <div class="login-login">
            <div class="text-center">
                <h3>Verify Your Email Address</h3>
                <p v-if="status" class="text-success">{{ status }}</p>
                <p v-else>Before proceeding, please check your email for a verification link.</p>
                
                <form @submit.prevent="submit" v-if="!status">
                    <button class="login-btn" type="submit" :disabled="form.processing">
                        Resend Verification Email
                    </button>
                </form>
            </div>
            <form action="">
                <button class="signup-btn" type="button" @click="goToLogin">Back to Login</button>
            </form>
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
    document.title = 'Verify Email - QuickBite';
});

defineProps<{
    status?: string;
}>();

const form = useForm({});

const submit = () => {
    form.post('/email/verification-notification', {
        onFinish: () => form.reset(),
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

.login-login h3 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.login-login p {
  text-align: center;
  margin-bottom: 20px;
  color: #666;
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

.text-success {
  color: green;
  text-align: center;
  padding-top: 10px;
  font-weight: bold;
}
</style>
