<template>
  <div>
    <div class="row">
      <router-link to="/pos" class="btn btn-primary ml-3 mb-4"
        >Place Order</router-link
      >
    </div>

    <div>
      <input
        type="text"
        class="form-control mb-4"
        style="width: 300px"
        placeholder="Search Here"
        v-model="searchTerm"
      />
    </div>

    <div class="row">
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
            <h6 class="m-0 font-weight-bold text-primary">Today Orders</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Total Amount</th>
                  <th>Pay</th>
                  <th>Due</th>
                  <th>Pay By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="order in filterSearch" :key="order.id">
                  <td>{{ order.name }}</td>
                  <td>{{ order.total }}</td>
                  <td>{{ order.due }}</td>
                  <td>{{ order.pay }}</td>
                  <td>{{ order.payby }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'view-order',
                        params: { id: order.id },
                      }"
                      class="btn btn-sm btn-primary"
                    >
                      View
                    </router-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
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
      orders: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.orders.filter((order) => {
        return order.name.match(this.searchTerm);
      });
    },
  },
  methods: {
    allOrder() {
      axios
        .get("/api/orders/")
        .then((res) => {
          console.log(res.data);
          this.orders = res.data;
        })
        .catch();
    },
  },
  created() {
    this.allOrder();
  },
};
</script>


