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
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                  </div>
                  <form class="user" @submit.prevent="signup">
                    <div class="form-group">
                      <label>Your Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="exampleInputLastName"
                        placeholder="Enter Full Name"
                        v-model="form.name"
                      />
                      <small class="text-danger" v-if="errors.name">{{
                        errors.name[0]
                      }}</small>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
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
                      <label>Password</label>
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
                      <label>Confirm Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="exampleInputPasswordRepeat"
                        placeholder="Confirm Password"
                        v-model="form.password_confirmation"
                      />
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Register
                      </button>
                    </div>
                  </form>
                  <hr />
                  <div class="text-center">
                    <router-link class="font-weight-bold small" to="/"
                      >Already have an account?</router-link
                    >
                  </div>
                  <div class="text-center"></div>
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
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      errors: {},
    };
  },
  methods: {
    signup() {
      axios
        .post("api/auth/signup", this.form)
        .then((res) => {
          User.responseAfterLogin(res);
          this.$router.push({ name: "/" });
          Toast.fire({
            icon: "success",
            title: "Logged in successfully",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors)); // this.errors = error.response.data.errors
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
