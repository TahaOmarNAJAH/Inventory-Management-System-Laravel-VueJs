<template>
<div>
    <div class="text-right">
        <router-link to="/expenses/index" class="btn btn-primary">All Expenses</router-link>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Edit Expense</h1>
                                </div>
                                <form @submit.prevent="updateExpense" enctype="multipart/form-data">
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
                                            Update
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
    name: 'EditExpense',
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getExpense();
    },
    data() {
        return {
            form: {
                details: '',
                amount: '',
            },
            errors: {},
        };
    },
    methods: {
        getExpense(){
        let expenseId = this.$route.params.id;
        axios
            .get(`/api/expenses/${expenseId}`)
            .then(({
                data
            }) => {
                this.form = data;
            })
            .catch((error) => {
                this.errors = error.response.data.errors;
                Notification.error();
            });
        },
        updateExpense() {
            let id = this.$route.params.id
            axios.patch('/api/expenses/' + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: 'all-expenses'
                    })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    },
}
</script>

<style scoped>

</style>
