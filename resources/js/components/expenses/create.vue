<template>
<div>
    <div class="text-right">
        <router-link to="/categories/index" class="btn btn-primary">All Expenses</router-link>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Add Expense</h1>
                                </div>
                                <form @submit.prevent="createExpense" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <label for="details">Expense Details</label>
                                                <textarea class="form-control" v-model="form.details" id="details" rows="4"/>
                                                <small class="text-danger" v-if="errors.details">
                                                    {{ errors.details[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <label for="amountInput">Expense Amount</label>
                                                <input v-model="form.amount" type="number" min="0" class="form-control" id="amountInput" placeholder="Enter Expense Amount" />
                                                <small class="text-danger" v-if="errors.amount">
                                                    {{ errors.amount[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'CreateExpense',
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
    },
    data() {
        return {
            form: {
                details: null,
                amount: null,
            },
            errors: {},
        };
    },
    methods: {
        createExpense() {
            axios
                .post("/api/expenses", this.form)
                .then((response) => {
                    this.$router.push({
                        name: "all-expenses"
                    });
                    Notification.success();
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    Notification.error()
                });

        },
    },
}
</script>

<style scoped>

</style>
