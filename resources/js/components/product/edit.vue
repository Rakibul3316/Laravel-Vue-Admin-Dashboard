<template>
  <div>
    <div>
      <div class="row">
        <router-link to="/product" class="btn btn-primary ml-3"
          >All Products</router-link
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
                    <h1 class="h4 text-gray-900 mb-4">Update Product</h1>
                  </div>

                  <form
                    class="user"
                    @submit.prevent="productUpdate"
                    enctype="multipart/form-data"
                  >
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="product_name"><b>Product Name</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="product_name"
                            placeholder="Enter Product Name"
                            v-model="form.product_name"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.product_name"
                            >{{ errors.product_name[0] }}</small
                          >
                        </div>
                        <div class="col-md-6">
                          <label for="product_code"><b>Product Code</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="product_code"
                            placeholder="Enter Product Code"
                            v-model="form.product_code"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.product_code"
                            >{{ errors.product_code[0] }}</small
                          >
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="product_category"
                            ><b>Product Category</b></label
                          >
                          <select
                            id="product_category"
                            class="form-control mb-2"
                            v-model="form.category_id"
                          >
                            <option
                              v-for="category in categories"
                              :key="category.id"
                              :value="category.id"
                            >
                              {{ category.category_name }}
                            </option>
                          </select>
                          <small class="text-danger" v-if="errors.category_id"
                            >{{ errors.category_id[0] }}
                          </small>
                        </div>

                        <div class="col-md-6">
                          <label for="product_supplier"
                            ><b>Product Supplier</b></label
                          >
                          <select
                            id="product_supplier"
                            class="form-control mb-2"
                            v-model="form.supplier_id"
                          >
                            <option
                              v-for="supplier in suppliers"
                              :key="supplier.id"
                              :value="supplier.id"
                            >
                              {{ supplier.name }}
                            </option>
                          </select>
                          <small class="text-danger" v-if="errors.supplier_id"
                            >{{ errors.supplier_id[0] }}
                          </small>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-4">
                          <label for="root"><b>Product Root</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="root"
                            placeholder="Enter Product Root"
                            v-model="form.root"
                          />
                          <small class="text-danger" v-if="errors.root">{{
                            errors.root[0]
                          }}</small>
                        </div>

                        <div class="col-md-4">
                          <label for="buying_price"><b>Buying Price</b></label>
                          <input
                            type="text"
                            class="form-control"
                            id="buying_price"
                            placeholder="Enter Buying Price"
                            v-model="form.buyign_price"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.buying_price"
                            >{{ errors.buying_price[0] }}</small
                          >
                        </div>

                        <div class="col-md-4">
                          <label for="selling_price"
                            ><b>Selling Price</b></label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="selling_price"
                            placeholder="Enter Selling Price"
                            v-model="form.selling_price"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.selling_price"
                            >{{ errors.selling_price[0] }}</small
                          >
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="buying_date"><b>Buying Date</b></label>
                          <input
                            type="date"
                            class="form-control"
                            id="buying_date"
                            v-model="form.buying_date"
                          />
                          <small
                            class="text-danger"
                            v-if="errors.buying_date"
                            >{{ errors.buying_date[0] }}</small
                          >
                        </div>
                        <div class="col-md-6">
                          <label for="product_quantity"
                            ><b>Product Quantity</b></label
                          >
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

    // Get Categories & Suppliers
    axios.get("/api/category/").then((res) => {
      this.categories = res.data;
    });

    axios.get("/api/supplier/").then((res) => {
      this.suppliers = res.data;
    });
  },
  data() {
    return {
      form: {
        product_name: "",
        product_code: "",
        category_id: "",
        supplier_id: "",
        root: "",
        buyign_price: "",
        selling_price: "",
        buying_date: "",
        product_quantity: "",
        image: "",
        newimage: "",
        image_src: "",
      },
      errors: {},
      categories: [],
      suppliers: [],
    };
  },
  methods: {
    onFiledSelected(event) {
      this.form.newimage = event.target.files[0];
      let file = event.target.files[0];
      if (file.size > 209754) {
        Notification.image_validation();
      }
    },
    productUpdate() {
      let id = this.$route.params.id;
      let fd = new FormData();
      fd.append("product_name", this.form.product_name);
      fd.append("product_code", this.form.product_code);
      fd.append("category_id", this.form.category_id);
      fd.append("supplier_id", this.form.supplier_id);
      fd.append("root", this.form.root);
      fd.append("buying_date", this.form.buying_date);
      fd.append("buyign_price", this.form.buyign_price);
      fd.append("selling_price", this.form.selling_price);
      fd.append("product_quantity", this.form.product_quantity);
      fd.append("image", this.form.image);
      fd.append("newimage", this.form.newimage);
      axios
        .post(`/api/product/${id}?_method=PUT`, fd)
        .then((res) => {
          this.$router.push({ path: "/product" });
          Notification.editSuccess();
        })
        .catch((error) => (this.errors = error.response.data.errors));
    },
  },
};
</script>


