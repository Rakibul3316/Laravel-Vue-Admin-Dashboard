<template>
  <div>
    <div>
      <div class="row">
        <router-link to="/customer" class="btn btn-primary ml-3"
          >All Customers</router-link
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
                    <h1 class="h4 text-gray-900 mb-4">Update Customer</h1>
                  </div>

                  <form
                    class="user"
                    @submit.prevent="customerUpdate"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="name"><b>Customer Name</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Enter Customer Name"
                            v-model="form.name"
                          />
                          <small class="text-danger" v-if="errors.name">{{
                            errors.name[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label for="email"><b>Customer Email</b></label>
                          <input
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Enter Customer Email"
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
                          <label for="phone"><b>Phone</b></label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Enter Customer Phone"
                            id="phone"
                            v-model="form.phone"
                          />
                          <small class="text-danger" v-if="errors.phone">{{
                            errors.phone[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label for="address"><b>Address</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="address"
                            placeholder="Enter Product Quantity"
                            v-model="form.address"
                          />
                          <small class="text-danger" v-if="errors.address">{{
                            errors.address[0]
                          }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <input
                            type="file"
                            class="custom-file-input"
                            id="customFile"
                            @change="onFiledSelected"
                          />
                          <label class="custom-file-label" for="customFile"
                            >Choose file</label
                          >
                        </div>
                        <div class="col-md-6">
                          <img
                            :src="form.image_src"
                            style="heigth: 60px; width: 60px"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Update Customer
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
    axios.get("/api/customer/" + id).then((res) => {
      this.form = res.data;
      //   console.log(res.data);
    });
  },
  data() {
    return {
      form: {
        name: null,
        email: null,
        phone: null,
        address: null,
        image: null,
        image_src: null,
        new_image: null,
      },
      errors: {},
    };
  },
  methods: {
    onFiledSelected(event) {
      this.form.new_image = event.target.files[0];
      let file = event.target.files[0];
      if (file.size > 209754) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.image_src = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    customerUpdate() {
      let id = this.$route.params.id;
      let fd = new FormData();
      fd.append("name", this.form.name);
      fd.append("email", this.form.email);
      fd.append("phone", this.form.phone);
      fd.append("address", this.form.address);
      fd.append("image", this.form.image);
      fd.append("new_image", this.form.new_image);
      axios
        .post(`/api/customer/${id}?_method=PUT`, fd)
        .then((res) => {
          console.log(res.data);
          this.$router.push({ path: "/customer" });
          Notification.success();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>
