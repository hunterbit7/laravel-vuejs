<template>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="#" alt="" class="login-card-img" />
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="@/assets/images/logo.png" alt="logo" class="logo" />
              </div>
              <p class="login-card-description">
                {{ $t('login.title') }}
              </p>
              <form @submit.prevent="submitForm">
                <div class="form-group">
                  <label for="email" class="sr-only">{{
                    $t('login.email')
                  }}</label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control input-login"
                    placeholder="Email address"
                    v-model="form.email"
                  />
                  <p v-if="showEmailAlert" class="error-login">
                    {{ $t('login.errors.email') }}
                  </p>
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">{{
                    $t('login.password')
                  }}</label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control input-login"
                    placeholder="***********"
                    v-model="form.password"
                  />
                </div>
                <p v-if="showPasswordAlert" class="error-login">
                  {{ $t('login.errors.password') }}
                </p>
                <input
                  name="login"
                  id="login"
                  class="btn btn-block login-btn mb-4"
                  type="submit"
                  value="Login"
                />
                <div v-if="error_server">
                  <p class="error-server">
                    {{ error_server }}
                  </p>
                </div>
              </form>
              <a href="#!" class="forgot-password-link">{{
                $t('login.forgot_password')
              }}</a>
              <!-- <p class="login-card-footer-text">
                Don't have an account?
                <a href="#!" class="text-reset">Register here</a>
              </p> -->
              <div class="checkbox mb-3">
                <input type="checkbox" value="lsRememberMe" id="rememberMe" />
                <label for="rememberMe">Remember me</label>
                <!-- <div v-if="error_server">
                  <h3>{{ error_server }}</h3>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script>
export default {
  middleware: 'auth',
  auth: 'guest',
  layout: 'login',
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      errors: {
        email: false,
        password: false,
        incorrect: false,
      },
      showEmailAlert: false,
      showPasswordAlert: false,
      token: null,
      error_server: '',
    }
  },
  methods: {
    async submitForm() {
      this.showEmailAlert = false
      this.showPasswordAlert = false
      if (this.form.email === null || this.form.email === '') {
        this.showEmailAlert = true
        return
      }
      if (this.form.password === null || this.form.password === '') {
        this.showPasswordAlert = true
        return
      }

      await this.$auth
        .loginWith('local', {
          data: this.form,
        })
        .catch((error) => {
          this.error_server = error.response.data.error
          return
        })
      await this.$router.push('/')
    },
  },
}
</script>
<style scoped>
.error-login {
  color: red;
  font-size: 12px;
  position: relative;
  bottom: 19px;
}
.error-server {
  color: red;
  font-size: 16px;
}
.check-input {
  position: relative;
  right: 5px;
}

.checkbox {
  padding-top: 20px !important;
  padding-left: 100px;
}
.login-card-img {
  background: linear-gradient(5deg, #b9470d, #242348) !important;
}
body {
  font-family: 'Karla', sans-serif;
  background-color: #d0d0ce;
  min-height: 100vh;
}

.brand-wrapper {
  margin-bottom: 19px;
}
.brand-wrapper .logo {
  height: 37px;
}

.login-card {
  border: 0;
  border-radius: 27.5px;
  box-shadow: 0 10px 30px 0 rgba(172, 168, 168, 0.43);
  overflow: hidden;
}
.login-card-img {
  border-radius: 0;
  position: absolute;
  width: 100%;
  height: 100%;
  -o-object-fit: cover;
  object-fit: cover;
}
.login-card .card-body {
  padding: 85px 60px 60px;
}
@media (max-width: 422px) {
  .login-card .card-body {
    padding: 35px 24px;
  }
}
.login-card-description {
  font-size: 25px;
  color: #000;
  font-weight: normal;
  margin-bottom: 23px;
}
.login-card form {
  max-width: 326px;
}
.login-card .form-control {
  border: 1px solid #d5dae2;
  padding: 15px 25px;
  margin-bottom: 20px;
  min-height: 45px;
  font-size: 13px;
  line-height: 15;
  font-weight: normal;
}
.login-card .form-control::-webkit-input-placeholder {
  color: #919aa3;
}
.login-card .form-control::-moz-placeholder {
  color: #919aa3;
}
.login-card .form-control:-ms-input-placeholder {
  color: #919aa3;
}
.login-card .form-control::-ms-input-placeholder {
  color: #919aa3;
}
.login-card .form-control::placeholder {
  color: #919aa3;
}
.input-login {
  width: 100% !important;
  margin-left: unset !important;
}
.login-card .login-btn {
  padding: 13px 20px 12px;
  background-color: #000;
  border-radius: 4px;
  font-size: 17px;
  font-weight: bold;
  line-height: 20px;
  color: #fff;
  margin-bottom: 24px;
  width: 100% !important;
  margin-left: unset !important;
}
.login-card .login-btn:hover {
  border: 1px solid #000;
  background-color: transparent;
  color: #000;
}
.login-card .forgot-password-link {
  font-size: 14px;
  color: #919aa3;
  margin-bottom: 12px;
}
.login-card-footer-text {
  font-size: 16px;
  color: #0d2366;
  margin-bottom: 60px;
}
input[type='text'] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type='email'] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type='password'] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type='text']:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type='text']:placeholder {
  color: #cccccc;
}
@media (max-width: 767px) {
  .login-card-footer-text {
    margin-bottom: 24px;
  }
}
.login-card-footer-nav a {
  font-size: 14px;
  color: #919aa3;
}

.footer-link {
  position: absolute;
  bottom: 1rem;
  text-align: center;
  width: 100%;
}
</style>