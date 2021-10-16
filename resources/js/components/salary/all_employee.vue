<template>
  <div>
    <div class="row">
      <router-link to="/salary" class="btn btn-primary ml-3 mb-4"
        >View Salary</router-link
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
            <h6 class="m-0 font-weight-bold text-primary">Employee Lists</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Sallery</th>
                  <th>Joining Date</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="employee in filterSearch" :key="employee.id">
                  <td>{{ employee.name }}</td>
                  <td>{{ employee.email }}</td>
                  <td>{{ employee.phone }}</td>
                  <td>{{ employee.sallery }}</td>
                  <td>{{ employee.joining_date }}</td>
                  <td><img :src="employee.photo" id="em_photo" /></td>
                  <td>
                    <router-link
                      :to="{
                        name: 'pay-salary',
                        params: { id: employee.id },
                      }"
                      class="btn btn-sm btn-primary"
                      >Pay Salary</router-link
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
  },
  data() {
    return {
      employees: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.employees.filter((employee) => {
        return employee.name.match(this.searchTerm);
      });
    },
  },
  methods: {
    allEmployee() {
      axios
        .get("/api/employee")
        .then(({ data }) => (this.employees = data))
        .catch();
    },
  },
  created() {
    this.allEmployee();
  },
};
</script>

<style scoped>
#em_photo {
  height: 40px;
  width: 40px;
}
</style>
