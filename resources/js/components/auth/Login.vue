<template>
  <div class="wrapper">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" @submit.prevent="login">
                    <div class="form-group">
                      <input
                        type="email"
                        class="form-control"
                        id="exampleInputEmail"
                        aria-describedby="emailHelp"
                        placeholder="Enter Email Address"
                        v-model="form.email"
                      />
                      <small class="text-danger" v-if="errors.email">{{
                        errors.email[0]
                      }}</small>
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        class="form-control"
                        id="exampleInputPassword"
                        placeholder="Password"
                        v-model="form.password"
                      />
                      <small class="text-danger" v-if="errors.password">{{
                        errors.password[0]
                      }}</small>
                    </div>
                    <div class="form-group">
                      <div
                        class="custom-control custom-checkbox small"
                        style="line-height: 1.5rem"
                      >
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          id="customCheck"
                        />
                        <label class="custom-control-label" for="customCheck"
                          >Remember Me</label
                        >
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Login
                      </button>
                    </div>
                  </form>
                  <hr />
                  <div class="text-center">
                    <router-link class="font-weight-bold small" to="register"
                      >Create an Account!</router-link
                    >
                  </div>
                  <div class="text-center">
                    <router-link class="font-weight-bold small" to="forget"
                      >Forget Password</router-link
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import User from "../helpers/User";

export default {
  created() {
    if (User.hasToken()) {
      this.$router.push({ name: "home" });
    }
  },
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
      errors: {},
    };
  },
  methods: {
    login() {
      axios
        .post("api/auth/login", this.form)
        .then((res) => {
          User.responseAfterLogin(res);
          this.$router.push({ name: "home" });
          Toast.fire({
            icon: "success",
            title: "Logged in successfully",
          });
          console.log(res.data);
        })
        .catch((error) => (this.errors = error.response.data.errors));
      // .catch(
      //   Toast.fire({
      //     icon: "warning",
      //     title: "Invalid Email & Password",
      //   })
      // );
    },
  },
};
</script>

<style scoped>
.wrapper {
  margin-left: 25rem;
  margin-right: 25rem;
}
</style>
