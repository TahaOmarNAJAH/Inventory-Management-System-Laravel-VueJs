<template>
<div>
    <div class="text-right">
        <router-link to="/categories/index" class="btn btn-primary">All Categories</router-link>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                                </div>
                                <form @submit.prevent="createCategory" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <input v-model="form.name" type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Category Name" />
                                                <small class="text-danger" v-if="errors.name">
                                                    {{ errors.name[0] }}
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
    name: 'CreateCategory',
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
                name: null,
            },
            errors: {},
        };
    },
    methods: {
        createCategory() {
            axios
                .post("/api/categories", this.form)
                .then((response) => {
                    this.$router.push({
                        name: "all-categories"
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
