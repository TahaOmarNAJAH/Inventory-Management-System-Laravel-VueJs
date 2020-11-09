<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Employees</h1>
        <div class="text-right">
            <router-link to="/salaries/index" class="btn btn-primary">Go Back</router-link>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Employees Salaries Details</h6>
                    <div>
                        <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Employee Name</th>
                                <th>Employee Email</th>
                                <th>Amount</th>
                                <th>Salary Month</th>
                                <th>Salary Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="salary in filterSearch" :key="salary.id">
                                <td>{{ salary.employee_name }}</td>
                                <td>{{ salary.employee_email }}</td>
                                <td>{{ salary.amount }}</td>
                                <td>{{ salary.salary_month }}</td>
                                <td>{{ salary.salary_date }}</td>
                                <td>
                                    <router-link :to="{ name: 'edit-salary', params:{id:salary.id} }" class="btn btn-sm btn-primary">Edit Salary</router-link>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>
</template>

<script>
export default {
    name: "Salary",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.viewSalaries();
    },
    data() {
        return {
            salaries: [],
            searchKeyword: "",
        };
    },
    computed: {
        filterSearch() {
            return this.salaries.filter((salary) => {
                return salary.employee_name.match(this.searchKeyword);
            });
        },
    },
    methods: {
        viewSalaries() {
            let month = this.$route.params.id;
            axios
                .get('/api/salaries/' + month)
                .then((response) => {
                    this.salaries = response.data.data;
                })
                .catch();
        },
    },
};
</script>

<style scoped>
</style>
