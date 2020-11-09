<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Employees</h1>
        <div class="text-right">
            <router-link to="/employees/create" class="btn btn-primary">Add Employee</router-link>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Employees List</h6>
                    <div>
                        <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Phone</th>
                                <th>Salary</th>
                                <th>Joining Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="employee in filterSearch" :key="employee.id">
                                <td>{{ employee.name }}</td>
                                <td>
                                    <img :src="'/'+employee.photo" alt="" width="50" height="50" />
                                </td>
                                <td>{{ employee.phone }}</td>
                                <td>{{ employee.salary }}</td>
                                <td>{{ employee.joining_date }}</td>
                                <td>
                                    <router-link :to="{ name: 'pay-salary', params:{id:employee.id} }" class="btn btn-sm btn-primary">Pay Salary</router-link>
                                    
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
        this.getEmployees();
    },
    data() {
        return {
            employees: [],
            searchKeyword: "",
        };
    },
    computed: {
        filterSearch() {
            return this.employees.filter((employee) => {
                return employee.name.match(this.searchKeyword);
            });
        },
    },
    methods: {
        getEmployees() {
            axios
                .get("/api/employees/")
                .then((response) => {
                    this.employees = response.data;
                })
                .catch();
        },
    },
};
</script>

<style scoped>
</style>
