<template>
  <div>
    <div>
      <div class="row">
        <router-link to="/expense" class="btn btn-primary ml-3"
          >All Expenses</router-link
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
                    <h1 class="h4 text-gray-900 mb-4">Update Expense</h1>
                  </div>

                  <form class="user" @submit.prevent="expenseUpdate">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label for="expense_amount"
                            ><b>Expense Amount</b></label
                          >
                          <input
                            type="text"
                            class="form-control mb-3"
                            id="expense_amount"
                            placeholder="Enter Expense Amount"
                            v-model="form.amout"
                          />
                          <small class="text-danger" v-if="errors.amout">{{
                            errors.amout[0]
                          }}</small>
                        </div>
                        <div class="col-md-12">
                          <label for="expense_details"
                            ><b>Expense Details</b></label
                          >
                          <textarea
                            class="form-control mb-3"
                            id="expense_details"
                            placeholder="Describe Expense Details"
                            rows="3"
                            v-model="form.details"
                          ></textarea>
                          <small class="text-danger" v-if="errors.details">{{
                            errors.details[0]
                          }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Update Expense
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
    axios.get(`/api/expense/${id}`).then((res) => {
      console.log(res.data);
      this.form = res.data;
    });
  },
  data() {
    return {
      form: {
        amout: "",
        details: "",
      },
      errors: {},
    };
  },
  methods: {
    expenseUpdate() {
      let id = this.$route.params.id;
      let fd = new FormData();
      fd.append("amount", this.form.amout);
      fd.append("details", this.form.details);
      axios
        .post(`http://127.0.0.1:8000/api/expense/${id}?_method=PUT`, fd)
        .then((res) => {
          // console.log(res.data);
          this.$router.push({ path: "/expense" });
          Notification.success();
        })
        .catch((error) => (this.errors = error.response.data.errors));
      console.log(`this.form`, this.form);
    },
  },
};
</script>
