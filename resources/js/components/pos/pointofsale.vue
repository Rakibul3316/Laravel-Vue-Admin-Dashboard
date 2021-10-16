<template>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Pos Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </div>

    <div class="row mb-3">
      <!-- Start Expense -->
      <div class="col-xl-5 col-lg-5">
        <div class="card mb-4">
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
            <a class="btn btn-sm btn-info"
              ><font color="#ffffff">Add Customer</font></a
            >
          </div>
          <!-- Start Expense Product Lists -->
          <div class="table-responsive" style="font-size: 12px">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Unit</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="cart in carts" :key="cart.id">
                  <td>{{ cart.pro_name }}</td>
                  <td>
                    <input
                      type="text"
                      readonly=""
                      style="width: 15px"
                      :value="cart.pro_quantity"
                    />
                    <button
                      @click.prevent="increment(cart.id)"
                      class="btn btn-sm btn-success"
                    >
                      +
                    </button>
                    <button
                      @click.prevent="decrement(cart.id)"
                      class="btn btn-sm btn-danger"
                      v-if="cart.pro_quantity >= 2"
                    >
                      -
                    </button>
                    <button
                      @click.prevent="decrement(cart.id)"
                      class="btn btn-sm btn-danger"
                      disabled
                      v-else=" "
                    >
                      -
                    </button>
                  </td>
                  <td>{{ cart.product_price }}</td>
                  <td>{{ cart.sub_total }}</td>
                  <td>
                    <a
                      @click="removeItem(cart.id)"
                      class="btn btn-sm btn-danger"
                      ><font style="color: #ffffff"
                        ><i class="far fa-trash-alt"></i></font
                    ></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- End Expense Product Lists -->

          <div class="card-footer">
            <!-- Start Calculate Expense -->
            <ul class="list-group">
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                Total Quantity: <strong>{{ qty }} $</strong>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                Sub Total: <strong>{{ subtotal }} $</strong>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                Vat: <strong>{{ vats.vat }} $</strong>
              </li>
              <li
                class="
                  list-group-item
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                Total:
                <strong>{{ (subtotal * vats.vat) / 100 + subtotal }} $</strong>
              </li>
            </ul>
            <!-- End Calculate Expense -->

            <!-- Start Seller form -->
            <form class="mt-5" @submit.prevent="orderdone">
              <label for="cus_name">Customer Name</label>
              <select class="form-control mb-2" v-model="customer_id">
                <option
                  :value="customer.id"
                  v-for="customer in customers"
                  :key="customer.id"
                >
                  {{ customer.name }}
                </option>
              </select>

              <label for="pay">Pay</label>
              <input type="text" class="form-control mb-2" v-model="pay" />

              <label for="due">Due</label>
              <input type="text" class="form-control mb-2" v-model="due" />

              <label for="pay_by">Pay By</label>
              <select class="form-control mb-2" v-model="payby">
                <option value="Handcash">Hand Cash</option>
                <option value="Cheaque">Cheaque</option>
                <option value="Giftcard">Gift Card</option>
              </select>

              <button type="submit" class="btn btn-success">Submit</button>
            </form>
            <!-- End Seller form -->
          </div>
        </div>
      </div>
      <!-- End Expense -->

      <!-- Start All Products -->
      <div class="col-xl-7 col-lg-7">
        <div class="card mb-4">
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
          </div>
          <!-- Start Heading Tabs -->
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a
                class="nav-link active"
                id="home-tab"
                data-toggle="tab"
                href="#home"
                role="tab"
                aria-controls="home"
                aria-selected="true"
                >All Product</a
              >
            </li>
            <li
              class="nav-item"
              v-for="category in categories"
              :key="category.id"
              role="presentation"
            >
              <a
                class="nav-link"
                id="profile-tab"
                data-toggle="tab"
                href="#profile"
                role="tab"
                aria-controls="profile"
                aria-selected="false"
                @click="subProducts(category.id)"
                >{{ category.category_name }}</a
              >
            </li>
          </ul>
          <!-- End Heading Tabs -->

          <!-- Start Content Tabs -->
          <div class="tab-content" id="myTabContent">
            <!-- Start All Products Tabs -->
            <div
              class="tab-pane fade show active"
              id="home"
              role="tabpanel"
              aria-labelledby="home-tab"
            >
              <div class="card-body">
                <div>
                  <input
                    type="text"
                    class="form-control mb-4"
                    style="width: 500px"
                    placeholder="Search Product"
                    v-model="searchTerm"
                  />
                </div>
                <div class="row">
                  <div
                    class="col-lg-3 col-md-3 col-sm-6 col-6"
                    v-for="product in filterSearch"
                    :key="product.id"
                  >
                    <div
                      class="single_product"
                      @click.prevent="addToCart(product.id)"
                    >
                      <div
                        class="card mb-2"
                        style="width: 7.5rem; padding: 7px"
                      >
                        <img
                          :src="product.image"
                          id="em_photo"
                          class="card-img-top"
                        />
                        <div class="card-body">
                          <h6 class="card-title">{{ product.product_name }}</h6>
                          <span
                            class="badge badge-success"
                            v-if="product.product_quantity >= 1"
                            >Avaiable {{ product.product_quantity }}</span
                          >
                          <span class="badge badge-danger" v-else=" "
                            >Stock Out</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End All Products Tabs -->

            <!-- Start Daynamic Products Tabs -->
            <div
              class="tab-pane fade"
              id="profile"
              role="tabpanel"
              aria-labelledby="profile-tab"
            >
              <div class="card-body">
                <div>
                  <input
                    type="text"
                    class="form-control mb-4"
                    style="width: 500px"
                    placeholder="Search Product"
                    v-model="getSearchTerm"
                  />
                </div>
                <div class="row">
                  <div
                    class="col-lg-3 col-md-3 col-sm-6 col-6"
                    v-for="getProduct in getFilterSearch"
                    :key="getProduct.id"
                  >
                    <div
                      class="single_product"
                      @click.prevent="addToCart(getProduct.id)"
                    >
                      <div
                        class="card mb-2"
                        style="width: 7.5rem; padding: 7px"
                      >
                        <img
                          :src="getProduct.image"
                          id="em_photo"
                          class="card-img-top"
                        />
                        <div class="card-body">
                          <h6 class="card-title">
                            {{ getProduct.product_name }}
                          </h6>
                          <span
                            class="badge badge-success"
                            v-if="getProduct.product_quantity >= 1"
                            >Avaiable {{ getProduct.product_quantity }}</span
                          >
                          <span class="badge badge-danger" v-else=" "
                            >Stock Out</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Dynamic Products Tabs -->
          </div>
          <!-- End Content Tabs -->
        </div>
      </div>
      <!-- End All Products -->
    </div>
    <!--Row-->
  </div>
  <!---Container Fluid-->
</template>

<script>
import User from "../helpers/User";

export default {
  created() {
    if (!User.hasToken()) {
      this.$router.push({ name: "/" });
    }

    this.allProduct();
    this.allCategory();
    this.subProducts();
    this.allCustomer();
    this.cartProduct();
    this.vat();
    Reload.$on("AfterAdd", () => {
      this.cartProduct();
    });
  },
  data() {
    return {
      customer_id: "",
      pay: "",
      due: "",
      payby: "",
      products: [],
      categories: [],
      getProducts: [],
      searchTerm: "",
      getSearchTerm: "",
      customers: [],
      carts: [],
      vats: [],
    };
  },
  computed: {
    filterSearch() {
      return this.products.filter((product) => {
        return product.product_name.match(this.searchTerm);
      });
    },
    getFilterSearch() {
      return this.getProducts.filter((getProduct) => {
        return getProduct.product_name.match(this.getSearchTerm);
      });
    },
    qty() {
      let sum = 0;
      for (let i = 0; i < this.carts.length; i++) {
        sum += parseFloat(this.carts[i].pro_quantity);
      }
      return sum;
    },
    subtotal() {
      let sum = 0;
      for (let i = 0; i < this.carts.length; i++) {
        sum +=
          parseFloat(this.carts[i].pro_quantity) *
          parseFloat(this.carts[i].product_price);
      }
      return sum;
    },
  },
  methods: {
    addToCart(id) {
      axios.get("/api/addToCart/" + id).then((res) => {
        Reload.$emit("AfterAdd");
        Notification.cart_success();
      });
    },
    cartProduct() {
      axios
        .get("/api/cart/product")
        .then(({ data }) => (this.carts = data))
        .catch();
    },
    removeItem(id) {
      axios
        .get("/api/remove/cart/" + id)
        .then(() => {
          Reload.$emit("AfterAdd");
          Notification.cart_delete();
        })
        .catch();
    },
    increment(id) {
      axios
        .get("/api/increment/" + id)
        .then(() => {
          Reload.$emit("AfterAdd");
          Notification.success();
        })
        .catch();
    },
    decrement(id) {
      axios
        .get("/api/decrement/" + id)
        .then(() => {
          Reload.$emit("AfterAdd");
          Notification.success();
        })
        .catch();
    },
    vat() {
      axios
        .get("/api/vats")
        .then(({ data }) => (this.vats = data))
        .catch();
    },
    allProduct() {
      axios
        .get("/api/product")
        .then(({ data }) => (this.products = data))
        .catch();
    },
    allCategory() {
      axios
        .get("/api/category")
        .then(({ data }) => (this.categories = data))
        .catch();
    },
    allCustomer() {
      axios
        .get("/api/customer")
        .then(({ data }) => (this.customers = data))
        .catch();
    },
    subProducts(id) {
      axios
        .get("/api/getting/product/" + id)
        .then(({ data }) => (this.getProducts = data))
        .catch();
    },
    orderdone() {
      let total = (this.subtotal * this.vats.vat) / 100 + this.subtotal;

      let formData = {
        quantity: this.qty,
        subtotal: this.subtotal,
        customer_id: this.customer_id,
        pay: this.pay,
        due: this.due,
        payby: this.payby,
        vat: this.vats.vat,
        total: total,
      };

      axios.post("/api/orderdone", formData).then(() => {
        Notification.success();
        this.$router.push({ path: "/order" });
      });
      console.log(formData);
    },
  },
};
</script>

<style scoped>
#em_photo {
  height: 90px;
  width: 100px;
}
.single_product {
  cursor: pointer;
}
</style>
