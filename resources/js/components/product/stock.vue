<template>
  <div>
    <div class="row">
      <router-link to="/store-product" class="btn btn-primary ml-3 mb-4"
        >Add Product</router-link
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
            <h6 class="m-0 font-weight-bold text-primary">Stock Lists</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Category</th>
                  <th>Buying Price</th>
                  <th>Status</th>
                  <th>Quantity</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in filterSearch" :key="product.id">
                  <td>{{ product.product_name }}</td>
                  <td>{{ product.product_code }}</td>
                  <td>{{ product.category_name }}</td>
                  <td>{{ product.buyign_price }}</td>
                  <td v-if="product.product_quantity >= 1">
                    <span class="badge badge-success">Avaiable</span>
                  </td>
                  <td v-else>
                    <span class="badge badge-danger">Stock Out</span>
                  </td>
                  <td>{{ product.product_quantity }}</td>
                  <td><img :src="product.image" id="em_photo" /></td>
                  <td>
                    <router-link
                      :to="{
                        name: 'edit-stock',
                        params: { id: product.id },
                      }"
                      class="btn btn-sm btn-primary"
                      >Edit</router-link
                    >
                  </td>
                </tr>
              </tbody>
            </table>
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
      products: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.products.filter((product) => {
        return product.name.match(this.searchTerm);
      });
    },
  },
  methods: {
    allProduct() {
      axios
        .get("/api/product")
        .then(({ data }) => (this.products = data))
        .catch();
    },
  },
  created() {
    this.allProduct();
  },
};
</script>

<style scoped>
#em_photo {
  height: 40px;
  width: 40px;
}
</style>
