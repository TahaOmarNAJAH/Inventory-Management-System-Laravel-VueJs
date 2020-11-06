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
                                <th>Email</th>
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
                                    <button class="btn btn-sm btn-primary">edit</button>
                                    <button @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger">
                                        delete
                                    </button>
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
    name: "index",
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
        deleteEmployee(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(`/api/employees/${id}`)
                        .then(() => {
                            this.employees = this.employees.filter((employee) => {
                                return employee.id != id;
                            });
                        })
                        .catch((error) => {
                            console.log(error.response.data)
                            Notification.error();
                        });
                    Swal.fire("Deleted!", "Your file has been deleted.", "success");
                }
            });
        },
    },
};
</script>

<style scoped>
</style>
