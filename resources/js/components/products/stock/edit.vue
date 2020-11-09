<template>
<div>
    <div class="text-right">
        <router-link to="/stock/index" class="btn btn-primary">Go back</router-link>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Update Stock</h1>
                                </div>
                                <form @submit.prevent="updateStock">

                                   
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <label for="exampleInputQuantity">Product Stock Quantity</label>
                                                <input v-model="form.product_quantity" type="number" min="0" class="form-control" id="exampleInputQuantity" aria-describedby="emailHelp" />
                                                <small class="text-danger" v-if="errors.product_quantity">
                                                    {{ errors.product_quantity[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Update Stock
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
    name: "EditStock",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getProduct();
    },
    data() {
        return {
            form: {
                product_quantity: '',
            },
            errors: {},
        };
    },
    methods: {
        getProduct() {
            let productId = this.$route.params.id;

            axios
                .get(`/api/products/${productId}`)
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
        updateStock() {

            let id = this.$route.params.id;
            axios
                .post("/api/stock/update/" + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: "stock",
                    });
                    Notification.success();
                })
                .catch((error) => {
                    (error) => (this.errors = error.response.data.errors);
                });
        },
    },
};
</script>

<style scoped>
</style>
