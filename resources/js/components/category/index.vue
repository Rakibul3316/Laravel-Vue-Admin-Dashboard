<template>
  <div>
    <div class="row">
      <router-link to="/store-category" class="btn btn-primary ml-3 mb-4"
        >Add Categories</router-link
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
            <h6 class="m-0 font-weight-bold text-primary">Category Lists</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Category Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in filterSearch" :key="category.id">
                  <td>{{ category.category_name }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'edit-category',
                        params: { id: category.id },
                      }"
                      class="btn btn-sm btn-primary"
                      >Edit</router-link
                    >
                    <a
                      @click="deleteCategory(category.id)"
                      class="btn btn-sm btn-danger"
                      ><font class="color: #ffffff;">Delete</font></a
                    >
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
    this.allCategory();
  },
  data() {
    return {
      categories: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.categories.filter((category) => {
        return category.category_name.match(this.searchTerm);
      });
    },
  },
  methods: {
    allCategory() {
      axios
        .get("/api/category")
        .then(({ data }) => (this.categories = data))
        .catch();
    },
    deleteCategory(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/category/" + id)
            .then(() => {
              this.categories = this.categories.filter((category) => {
                return category.id != id;
              });
            })
            .catch(() => {
              this.$router.push({ name: category });
            });
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
  },
};
</script>

<style scoped>
#em_photo {
  height: 40px;
  width: 40px;
}
</style>
