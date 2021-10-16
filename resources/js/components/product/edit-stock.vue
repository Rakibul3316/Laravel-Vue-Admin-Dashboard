<template>
  <div>
    <div>
      <div class="row">
        <router-link to="/stock" class="btn btn-primary ml-3"
          >Go Back</router-link
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
                    <h1 class="h4 text-gray-900 mb-4">
                      Update Stock Information
                    </h1>
                  </div>

                  <form
                    class="user"
                    @submit.prevent="stockUpdate"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label for="product_name">Product Quantity</label>
                          <input
                            type="text"
                            class="form-control"
                            id="product_quantity"
                            placeholder="Enter Product Quantity"
                            v-model="form.product_quantity"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.product_quantity"
                            >{{ errors.product_quantity[0] }}</small
                          >
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Update Product
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
      .get("/api/product/" + id)
      .then((res) => {
        this.form = res.data;
        console.log("single user response", res.data);
      })
      .catch((error) => console.log(error));
  },
  data() {
    return {
      form: {
        product_quantity: "",
      },
      errors: {},
    };
  },
  methods: {
    stockUpdate() {
      let id = this.$route.params.id;
      let fd = new FormData();
      fd.append("product_quantity", this.form.product_quantity);
      axios
        .post(`/api/stock/update/${id}?_method=PUT`, fd)
        .then((res) => {
          this.$router.push({ path: "/stock" });
          Notification.editSuccess();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>


