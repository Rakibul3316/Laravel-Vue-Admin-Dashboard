<template>
  <div>
    <div>
      <div class="row">
        <router-link to="/given-salary" class="btn btn-primary ml-3"
          >Back</router-link
        >
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                  </div>

                  <form class="user" @submit.prevent="salaryPaid">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="name"><b>Name</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="name"
                            v-model="form.name"
                          />
                          <small class="text-danger" v-if="errors.name">{{
                            errors.name[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label for="email"><b>Email</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="email"
                            v-model="form.email"
                          />
                          <small class="text-danger" v-if="errors.email">{{
                            errors.email[0]
                          }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="month"><b>Month</b></label>
                          <select
                            id="month"
                            class="form-control mb-2"
                            v-model="form.month"
                          >
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          </select>
                          <small class="text-danger" v-if="errors.month"
                            >{{ errors.month[0] }}
                          </small>
                        </div>

                        <div class="col-md-6">
                          <label for="salary"><b>Salary</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="salary"
                            v-model="form.sallery"
                          />
                          <small class="text-danger" v-if="errors.sallery">{{
                            errors.sallery[0]
                          }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Pay Now
                      </button>
                    </div>
                  </form>
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
    if (!User.hasToken()) {
      this.$router.push({ name: "/" });
    }

    let id = this.$route.params.id;
    axios
      .get("/api/employee/" + id)
      .then((res) => {
        this.form = res.data;
        // console.log("single user response", res.data);
      })
      .catch((error) => console.log(error));
  },
  data() {
    return {
      form: {
        name: null,
        email: null,
        month: null,
        sallery: null,
      },
      errors: {},
    };
  },
  methods: {
    salaryPaid() {
      let id = this.$route.params.id;
      let fd = new FormData();
      fd.append("name", this.form.name);
      fd.append("email", this.form.email);
      fd.append("month", this.form.month);
      fd.append("sallery", this.form.sallery);
      axios
        .post(`/api/salary/paid/${id}`, fd)
        .then((res) => {
          console.log(res.data);
          this.$router.push({ path: "/given-salary" });
          Notification.salary_success();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>
