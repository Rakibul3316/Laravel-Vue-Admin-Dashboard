<template>
  <div>
    <div class="row">
      <router-link to="/salary" class="btn btn-primary ml-3 mb-4"
        >Go Back</router-link
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
            <h6 class="m-0 font-weight-bold text-primary">
              Employee Salary Details
            </h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <!-- <th>Action</th> -->
                </tr>
              </thead>
              <tbody>
                <tr v-for="salary in filterSearch" :key="salary.id">
                  <td>{{ salary.name }}</td>
                  <td>{{ salary.salary_month }}</td>
                  <td>{{ salary.amount }}</td>
                  <td>{{ salary.salary_date }}</td>
                  <!-- <td>
                    <router-link
                      :to="{
                        name: 'edit-salary',
                        params: { id: salary.id },
                      }"
                      class="btn btn-sm btn-primary"
                      >Edit</router-link
                    >
                  </td> -->
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
      salaries: [],
      searchTerm: "",
    };
  },
  computed: {
    filterSearch() {
      return this.salaries.filter((salary) => {
        return salary.name.match(this.searchTerm);
      });
    },
  },
  methods: {
    viewSalary() {
      let id = this.$route.params.id;
      axios.get(`/api/salary/view/${id}`).then((res) => {
        this.salaries = res.data;
      });
    },
  },
  created() {
    this.viewSalary();
  },
};
</script>

<style scoped>
#em_photo {
  height: 40px;
  width: 40px;
}
</style>
