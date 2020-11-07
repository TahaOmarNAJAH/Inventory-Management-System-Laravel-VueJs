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
                                <th>Image</th>
                                <th>Category</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Quantity</th>
                                <th>Supplier</th>
                                <th>Root</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in filterSearch" :key="product.id">
                                <td>{{ product.name }}</td>
                                <td>
                                    <img :src="'/'+product.image" alt="" width="50" height="50" />
                                </td>
                                <td>{{ product.category_name }}</td>
                                <td>{{ product.buying_price }}</td>
                                <td>{{ product.selling_price }}</td>
                                <td>{{ product.product_quantity }}</td>
                                <td>{{ product.supplier_name }}</td>
                                <td>{{ product.root }}</td>
                                <td>
                                    <router-link :to="{ name: 'edit-product', params:{id:product.id} }" class="btn btn-sm btn-primary">edit</router-link>
                                    <button @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">
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
</div>
</template>

<script>
export default {
    name: 'Products',
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
        deleteProduct(id) {
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
                        .delete(`/api/products/${id}`)
                        .then(() => {
                            this.products = this.products.filter((product) => {
                                return product.id != id;
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
