<template lang="">
    <div class="container-fluid" id="container-wrapper">
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  Dashboard
                </li>
              </ol>
            </div>

            <div class="row mb-3">
              <!-- Today Sell Amount Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Today Sell Amount
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ sell }} ৳
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Earnings (Annual) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Today Sale
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ income }} ৳
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- New User Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Today Due
                        </div>
                        <div
                          class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                        >
                          {{ due }} ৳
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments-dollar fa-3x text-info"></i>
                        <!-- <i class="fas fa-comments-dollar"></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-uppercase mb-1"
                        >
                          Today Expense
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ expense }} ৳
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-money-bill-wave fa-2x text-warning"></i>
                        <!-- <i class=""></i> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
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
            <h6 class="m-0 font-weight-bold text-primary">Stock Out Lists</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Photo</th>
                  <th>Buying Price</th>
                  <th>Status</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products" :key="product.id">
                  <td>{{ product.product_name }}</td>
                  <td>{{ product.product_code }}</td>
                  <td><img :src="product.image" id="em_photo" /></td>
                  <td>{{ product.buyign_price }} ৳</td>
                  <td v-if="product.product_quantity >= 1">
                    <span class="badge badge-success">Avaiable</span>
                  </td>
                  <td v-else=" ">
                    <span class="badge badge-danger">Stock Out</span>
                  </td>
                  <td>{{ product.product_quantity }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
            </div>
            <!--Row-->
            </div>
</template>
<script>
import User from "./helpers/User";
export default {
  created() {
    if (!User.hasToken()) {
      this.$router.push({ name: "/" });
    }
    this.todaySell();
    this.todayIncome();
    this.todayDue();
    this.todayExpense();
    this.todayStockOut();
  },
  data() {
    return {
      sell: "",
      due: "",
      income: "",
      expense: "",
      products: [],
    };
  },
  methods: {
    todaySell() {
      axios
        .get("/api/today/sell")
        .then((res) => {
          this.sell = res.data;
        })
        .catch();
    },
    todayIncome() {
      axios
        .get("/api/today/income")
        .then((res) => {
          this.income = res.data;
        })
        .catch();
    },
    todayDue() {
      axios
        .get("/api/today/due")
        .then((res) => {
          this.due = res.data;
        })
        .catch();
    },
    todayExpense() {
      axios
        .get("/api/today/expense")
        .then((res) => {
          this.expense = res.data;
        })
        .catch();
    },
    todayStockOut() {
      axios
        .get("/api/today/stockout")
        .then((res) => {
          this.products = res.data;
        })
        .catch();
    },
  },
};
</script>
<style scoped>
#em_photo {
  height: 40px;
  width: 50px;
}
</style>