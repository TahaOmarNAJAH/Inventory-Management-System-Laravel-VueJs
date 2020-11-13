<template>
<div>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Point Of Sale</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pos</li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- A -->
            <div class="col-xl-5 col-lg-5">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>

                        <router-link to="/customers/create" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add Customer</span>
                        </router-link>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" style="font-size: 12px">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cartproduct in cart" :key="cartproduct.id">
                                    <td>{{ cartproduct.product_name }}</td>
                                    <td style="width: 300px">
                                        <input type="text" readonly="" :value="cartproduct.quantity" style="width: 23px" />
                                        <button @click.prevent="incrementQty(cartproduct.id)" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button @click.prevent="decrementQty(cartproduct.id)" v-if="cartproduct.quantity >= 2" class="btn btn-danger  btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button v-else class="btn btn-danger  btn-sm" disabled>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </td>
                                    <td>{{ cartproduct.product_price }}</td>
                                    <td>{{ cartproduct.sub_total }}</td>
                                    <td>
                                        <button @click.prevent="removeItem(cartproduct.id)" class="btn btn-primary btn-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Quantity: <strong>{{ totalQuantity }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sub total: <strong>{{subTotalSum}} $</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                VAT: <strong>{{ vats.vat }} %</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Amount: <strong>{{total}} $</strong>
                            </li>
                        </ul>
                        <div style="margin-top: 30px">
                            <form @submit.prevent="saveOrder">
                                <div class="form-group">
                                    <div class="form-row">
                                        <label for="customerName">Customer Name</label>
                                        <select class="form-control" v-model="customer_id" id="customerName">
                                            <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                                {{ customer.name }}
                                            </option>
                                            <small class="text-danger" v-if="errors.customer_id">
                                                {{ errors.customer_id[0] }}
                                            </small>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <label for="payInput">Pay</label>
                                        <input type="number" min="0" class="form-control" v-model="pay" id="payInput" />
                                        <small class="text-danger" v-if="errors.pay">
                                            {{ errors.pay[0] }}
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <label for="dueInput">Due</label>
                                        <input type="number" min="0" class="form-control" v-model="due" id="dueInput" />
                                        <small class="text-danger" v-if="errors.due">
                                            {{ errors.due[0] }}
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <label for="pyBySelect">Pay By</label>
                                        <select class="form-control" v-model="pay_by" id="pyBySelect">
                                            <option value="HandCash">Hand Cash</option>
                                            <option value="Cheaque">Cheaque</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.pay_by">
                                            {{ errors.pay_by[0] }}
                                        </small>
                                    </div>
                                </div>
                                <!-- <input type="hidden" v-model="customer_id"> -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- B -->
            <div class="col-xl-7 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                    </div>

                    <!-- Categories wise Products -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Products</a>
                        </li>
                        <li v-for="category in categories" :key="category.id" class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" @click="getProductsByCategory(category.id)" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ category.name }}</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- All Products -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body">
                                <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" style="margin-bottom: 8px" />
                                <div col-lg-3 col-md-3 col-sm-6 col-6>
                                    <div class="row">
                                        <div v-for="product in AllProductsFilterSearch" :key="product.id" class="card" style="width: 10.4rem; margin: 5px">
                                            <button class="btn btn-fix" @click.prevent="addToCart(product.id)">
                                                <img class="card-img-top" :src="'/' + product.image" />
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ product.name }}</h5>
                                                    <p class="card-text text-center">
                                                        <span v-if="product.product_quantity >= 1" class="badge badge-success">Available: {{ product.product_quantity }}</span>
                                                        <span v-else class="badge badge-danger">Out of Stock</span>
                                                    </p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End All Products -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- Products By Category -->
                            <div class="card-body">
                                <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" style="margin-bottom: 8px" />
                                <div col-lg-3 col-md-3 col-sm-6 col-6>
                                    <div class="row">
                                        <div v-for="filtredProduct in ProductsByCategoryFilterSearch" :key="filtredProduct.id" class="card" style="width: 10.4rem; margin: 5px">
                                            <button class="btn btn-fix" @click.prevent="addToCart(filtredProduct.id)">
                                                <img class="card-img-top" :src="'/' + filtredProduct.image" />
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        {{ filtredProduct.name }}
                                                    </h5>
                                                    <p class="card-text text-center">
                                                        <span v-if="filtredProduct.product_quantity >= 1" class="badge badge-success">Available:
                                                            {{ filtredProduct.product_quantity }}</span>
                                                        <span v-else class="badge badge-danger">Out of Stock</span>
                                                    </p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Products By Category -->
                        </div>
                    </div>
                    <!-- End Categories wise Products -->
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
</div>
</template>

<script>
export default {
    name: "Pos",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getProducts();
        this.getCategories();
        this.getCustomers();
        this.cartProdcuts();
        this.vat();
        Reload.$on("AfterAdding", () => {
            this.cartProdcuts();
        });
    },
    data() {
        return {
            customer_id: "",
            pay: "",
            due: "",
            pay_by: "",
            products: [],
            categories: [],
            customers: [],
            productsByCategory: [],
            searchKeyword: "",
            cart: [],
            vats: [],
            errors: {},
        };
    },
    computed: {
        AllProductsFilterSearch() {
            return this.products.filter((product) => {
                return product.name.match(this.searchKeyword);
            });
        },
        ProductsByCategoryFilterSearch() {
            return this.productsByCategory.filter((product) => {
                return product.name.match(this.searchKeyword);
            });
        },
        totalQuantity() {
            let sum = 0;
            for (let i = 0; i < this.cart.length; i++) {
                sum += this.cart[i].quantity;
            }
            return sum;
        },
        subTotalSum() {
            let sum = 0;
            for (let i = 0; i < this.cart.length; i++) {
                sum += this.cart[i].sub_total;
            }
            return sum;
        },
        total() {
            let total = 0;
            total = ((this.subTotalSum * this.vats.vat / 100) + this.subTotalSum);
            return total;
        }
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
        getCategories() {
            axios
                .get("/api/categories/")
                .then((response) => {
                    console.log(response);
                    this.categories = response.data;
                })
                .catch();
        },
        getProductsByCategory(id) {
            axios
                .get(`/api/products/category/${id}`)
                .then((response) => {
                    this.productsByCategory = response.data.data;
                })
                .catch();
        },
        addToCart(id) {
            axios
                .get(`/api/addToCart/${id}`)
                .then(() => {
                    Reload.$emit("AfterAdding");
                    Notification.cartSuccess();
                })
                .catch();
        },
        cartProdcuts() {
            axios
                .get("/api/cart/products/")
                .then((response) => {
                    console.log(response);
                    this.cart = response.data;
                })
                .catch();
        },
        getCustomers() {
            axios
                .get("/api/customers/")
                .then((response) => {
                    console.log(response);
                    this.customers = response.data;
                })
                .catch();
        },
        incrementQty(id) {
            axios
                .get("/api/cart/increment/" + id)
                .then(() => {
                    Reload.$emit("AfterAdding");
                })
                .catch();
        },
        decrementQty(id) {
            axios
                .get("/api/cart/decrement/" + id)
                .then(() => {
                    Reload.$emit("AfterAdding");
                })
                .catch();
        },
        removeItem(id) {
            axios
                .get("/api/cart/delete/" + id)
                .then(() => {
                    Reload.$emit("AfterAdding");
                })
                .catch();
        },
        vat() {
            axios
                .get("/api/vats/")
                .then((response) => {
                    this.vats = response.data;
                })
                .catch();
        },
        saveOrder() {
            
            let data = {
                customer_id: this.customer_id,
                total: this.total,
                pay: this.pay,
                pay_by: this.pay_by,
                due: this.due,
            }

            axios
                .post('/api/order/save', data)
                .then(() => {
                    Notification.cartSuccess();
                    this.$router.push({
                        name: orders
                    });
                })
                .catch((error) => {
                     this.errors = error.response.data.errors;
                    }
                );

        },
    },
};
</script>

<style scoped>
.btn-fix {
    padding: 0;
    border: none;
    white-space: normal;
}
</style>
