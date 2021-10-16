<template>
  <div>
    <div>
      <div class="row">
        <router-link to="/category" class="btn btn-primary ml-3"
          >All Categories</router-link
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
                    <h1 class="h4 text-gray-900 mb-4">Insert A Category</h1>
                  </div>

                  <form class="user" @submit.prevent="categoryInsert">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label><b>Category Name</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="Enter Category Name"
                            v-model="form.category_name"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.category_name"
                            >{{ errors.category_name[0] }}</small
                          >
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Add Category
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
  },
  data() {
    return {
      form: {
        category_name: null,
      },
      errors: {},
    };
  },
  methods: {
    categoryInsert() {
      let fd = new FormData();
      fd.append("category_name", this.form.category_name);
      axios
        .post("/api/category", fd)
        .then((res) => {
          console.log(res.data);
          this.$router.push({ path: "/category" });
          Notification.success();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>
