<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Salaries Details</h1>
        <div class="text-right">
            <router-link to="/given-salary" class="btn btn-primary">Pay Salary</router-link>
        </div>
    </div>

    <div class="row"> 
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Salaries List</h6>
                    <div>
                        <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Mounth</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="salary in filterSearch" :key="salary.id">
                                <td>{{ salary.salary_mounth }}</td>
                                <td>
                                    <router-link :to="{ name: 'view-salary', params:{id:salary.salary_mounth} }" class="btn btn-sm btn-primary">View Salaries</router-link>
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
    name: "Salaries",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getSalaries();
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
                return salary.salary_mounth.match(this.searchKeyword);
            });
        },
    },
    methods: {
        getSalaries() {
            axios
                .get("/api/salaries/")
                .then((response) => {
                    this.salaries = response.data;
                })
                .catch();
        },
    },
};
</script>

<style scoped>
</style>
