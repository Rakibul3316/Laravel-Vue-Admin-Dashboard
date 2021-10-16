<template>
  <div>
    <div>
      <div class="row">
        <router-link to="/employee" class="btn btn-primary ml-3"
          >All Employees</router-link
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
                    <h1 class="h4 text-gray-900 mb-4">Update Employee</h1>
                  </div>

                  <form
                    class="user"
                    @submit.prevent="employeeUpdate"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label><b>Employee Name</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="Enter Name"
                            v-model="form.name"
                          />
                          <small class="text-danger" v-if="errors.name">{{
                            errors.name[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label><b>Employee Email</b></label>
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
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label><b>Employee Phone</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="Enter Phone Number"
                            v-model="form.phone"
                          />
                          <small class="text-danger" v-if="errors.phone">{{
                            errors.phone[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label><b>Employee Address</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="Enter Address"
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
                          <label><b>Employee Salary</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="Enter Salary"
                            v-model="form.sallery"
                          />
                          <small class="text-danger" v-if="errors.sallery">{{
                            errors.sallery[0]
                          }}</small>
                        </div>
                        <div class="col-md-6">
                          <label><b>Employee NID</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="Enter NID Number"
                            v-model="form.nid"
                          />
                          <small class="text-danger" v-if="errors.nid">{{
                            errors.nid[0]
                          }}</small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label><b>Employee Joining Date</b></label>
                          <input
                            type="date"
                            class="form-control"
                            id="exampleInputEmail"
                            aria-describedby="emailHelp"
                            placeholder="Enter Joining Date"
                            v-model="form.joining_date"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.joining_date"
                            >{{ errors.joining_date[0] }}</small
                          >
                        </div>
                        <div class="col-md-6"></div>
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
                            :src="form.photo_src"
                            style="heigth: 60px; width: 60px"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">
                        Update Employee
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
        console.log("single user response", res.data);
      })
      .catch((error) => console.log(error));
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        address: "",
        sallery: "",
        nid: "",
        joining_date: "",
        photo: "",
        newphoto: "",
      },
      errors: {},
    };
  },
  methods: {
    onFiledSelected(event) {
      this.form.newphoto = event.target.files[0];
      let file = event.target.files[0];
      if (file.size > 209754) {
        Notification.image_validation();
      }
    },
    employeeUpdate() {
      let id = this.$route.params.id;
      let formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("email", this.form.email);
      formData.append("address", this.form.address);
      formData.append("sallery", this.form.sallery);
      formData.append("nid", this.form.nid);
      formData.append("joining_date", this.form.joining_date);
      formData.append("phone", this.form.phone);
      formData.append("photo", this.form.photo);
      formData.append("newphoto", this.form.newphoto);
      axios
        .post(`/api/employee/${id}?_method=PUT`, formData)
        .then((res) => {
          console.log("return data from edit", res.data);
          this.$router.push({ path: "/employee" });
          Notification.editSuccess();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>


