<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Expenses</h1>
        <div class="text-right">
            <router-link to="/expenses/create" class="btn btn-primary">Add Expense</router-link>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Expenses List</h6>
                    <div>
                        <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Expense Amount</th>
                                <th>Expense Details</th>
                                <th>Expense Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="expense in filterSearch" :key="expense.id">
                                <td>{{ expense.amount }}</td>
                                <td>{{ expense.details }}</td>
                                <td>{{ expense.expense_date }}</td>
                                <td>
                                    <router-link :to="{ name: 'edit-expense', params:{id:expense.id} }" class="btn btn-sm btn-primary">edit</router-link>
                                    <button @click="deleteCategory(expense.id)" class="btn btn-sm btn-danger">
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
    name: 'Expenses',
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getExpenses();
    },
    data() {
        return {
            expenses: [],
            searchKeyword: "",
        };
    },
    computed: {
        filterSearch() {
            return this.expenses.filter((expense) => {
                return expense.details.match(this.searchKeyword);
            });
        },
    },
    methods: {
        getExpenses() {
            axios
                .get("/api/expenses/")
                .then((response) => {
                    this.expenses = response.data;
                })
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
                if (result.isConfirmed) {
                    axios
                        .delete(`/api/expenses/${id}`)
                        .then(() => {
                            this.expenses = this.expenses.filter((expense) => {
                                return expense.id != id;
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
}
</script>

<style scoped>

</style>
