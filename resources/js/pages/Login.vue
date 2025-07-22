<template>
    <div class="container my-5">
        <header class="login-header">
            <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-color-and-shapes-3/177800/130-512.png"
                alt="" class="login-avatar">
        </header>
        <div class="login-login">
            <form action="#" @submit.prevent="onSubmit" @keydown="clearErrors">
                <label for="">Email</label>
                <input type="text" v-model="username">
                <label for="">Password</label>
                <input type="password" v-model="password">
                <div class="warning" v-show="errors.hasError"> {{ errors.message }} </div>
                <button class="login-btn">Login</button>
            </form>
            <form action="">
                <button class="signup-btn">Register</button>
            </form>
        </div>
        <footer class="login-footer">
            <a href="">Forgot your Password?</a>
        </footer>
    </div>
</template>
<script>
export default {

    data() {
        return {
            username: '',
            password: '',
            username2: '',
            password2: '',
            credentials: {
                username: 'tiko', password: 'miko',
            },
            errors: {
                hasError: false,
                message: ''
            }
        };
    },

    methods: {
        onSubmit() {
            if (this.credentials.username !== this.username || this.credentials.password !== this.password) {
                this.errors.hasError = true;
                this.errors.message = 'Invalid credentials!';
            } else {
                alert('Success!');
            }
        },
        clearErrors() {
            this.errors.hasError = false;
            this.errors.message = '';
        }
    }
}
</script>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Montserrat);

body {
  background: lightblue;
  font-family: 'Montserrat';
}

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

.login-btn {
  background: #4CAF50;
}

.signup-btn {
  background: #2196F3;
}


.warning {
  color: red;
  text-align: center;
  padding-top: 10px;
}
</style>