<template>
<div>
    <div class="text-right">
        <router-link to="/salaries/index" class="btn btn-primary">Go back</router-link>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Edit Salary</h1>
                                </div>
                                <form @submit.prevent="salaryUpdate">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="exampleInputName">Employee Name</label>
                                                <input v-model="form.employee_name" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="Enter Full Name" />
                                                <small class="text-danger" v-if="errors.employee_name">
                                                    {{ errors.employee_name[0] }}
                                                </small>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="exampleInputEmail">Employee Email</label>
                                                <input v-model="form.employee_email" type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address" />
                                                <small class="text-danger" v-if="errors.employee_email">
                                                    {{ errors.employee_email[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="selectMonth">Months</label>
                                                <select class="select2-single-placeholder form-control" v-model="form.salary_month" id="selectMonth">
                                                    <option value="January" >January</option>
                                                    <option value="Februray" >Februray</option>
                                                    <option value="March" >March</option>
                                                    <option value="April" >April</option>
                                                    <option value="May" >May</option>
                                                    <option value="Jun" >Jun</option>
                                                    <option value="July" >July</option>
                                                    <option value="August" >August</option>
                                                    <option value="September" >September</option>
                                                    <option value="October" >October</option>
                                                    <option value="November" >November</option>
                                                    <option value="December" >December</option>
                                                </select>
                                                <small class="text-danger" v-if="errors.salary_month">
                                                    {{ errors.salary_month[0] }}
                                                </small>
                                            </div>

                                            <input type="hidden" v-model="form.employee_id" >
                                           
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="exampleInputSalary">Amount</label>
                                                <input v-model="form.amount" type="number" min="0" step="0.01" class="form-control" id="exampleInputSalary" aria-describedby="emailHelp" placeholder="Enter Salary" />
                                                <small class="text-danger" v-if="errors.amount">
                                                    {{ errors.amount[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Update Salary
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
    name: "EditSalary",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }

        this.getEmployee();
    },
    data() {
        return {
            form: {
                employee_id: '',
                employee_name: '',
                employee_email: '',
                amount: '',
                salary_month: '',

            },
            errors: {},
        };
    },
    methods: {
        getEmployee() {
            let employeeId = this.$route.params.id;
            axios
                .get(`/api/edit/salary/${employeeId}`)
                .then(({
                    data
                }) => {
                    this.form = data.data;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    Notification.error();
                });
        },
        salaryUpdate() {
            let id = this.$route.params.id
            axios.post('/api/salary/update/' + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: 'all-salaries'
                    })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    },
};
</script>

<style scoped>
</style>
