<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Products</h1>
        <div class="text-right">
            <router-link to="/products/create" class="btn btn-primary">Add Product</router-link>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
                    <div>
                        <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Buying Price</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in filterSearch" :key="product.id">
                                <td>{{ product.name }}</td>
                                <td>{{ product.code }}</td>
                                <td>
                                    <img :src="'/'+product.image" alt="" width="50" height="50" />
                                </td>
                                <td>{{ product.category_name }}</td>
                                <td>{{ product.buying_price }}</td>
                                <td v-if="product.product_quantity >= 1"><span class="badge badge-success">Available</span> </td>
                                <td v-else><span class="badge badge-danger">Out of Stock</span> </td>
                                <td>{{ product.product_quantity }}</td>
                                <td>
                                    <router-link :to="{ name: 'edit-stock', params:{id:product.id} }" class="btn btn-sm btn-primary">edit</router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'Stock',
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getProducts();
    },
    data() {
        return {
            products: [],
            searchKeyword: "",
        };
    },
    computed: {
        filterSearch() {
            return this.products.filter((product) => {
                return product.name.match(this.searchKeyword);
            });
        },
    },
    methods: {
        getProducts() {
            axios
                .get("/api/products/")
                .then((response) => {
                    console.log(response);
                    this.products = response.data.data;
                })
                .catch();
        },
    },
}
</script>

<style scoped>

</style>
