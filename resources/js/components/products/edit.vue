<template>
<div>
    <div class="text-right">
        <router-link to="/products/index" class="btn btn-primary">All Products</router-link>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Edit Product</h1>
                                </div>
                                <form @submit.prevent="updateProduct" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="inputName">Name</label>
                                                <input v-model="form.name" type="text" class="form-control" id="inputName" aria-describedby="emailHelp" placeholder="Enter Product Name" />
                                                <small class="text-danger" v-if="errors.name">
                                                    {{ errors.name[0] }}
                                                </small>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="inputCode">Code</label>
                                                <input v-model="form.code" type="text" class="form-control" id="inputCode" aria-describedby="emailHelp" placeholder="Enter Product Code" />
                                                <small class="text-danger" v-if="errors.code">
                                                    {{ errors.code[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="selectCategory">Category</label>
                                                <select class="select2-single-placeholder form-control" v-model="form.category_id" id="selectCategory">
                                                    <option :value="category.id" v-for="category in categories" :key="category.id">
                                                        {{ category.name }}
                                                    </option>
                                                </select>
                                                <small class="text-danger" v-if="errors.category_id">
                                                    {{ errors.category_id[0] }}
                                                </small>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="selectSupplier">Supplier</label>
                                                <select class="select2-single-placeholder form-control" v-model="form.supplier_id" id="selectSupplier">
                                                    <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">
                                                        {{ supplier.name }}
                                                    </option>
                                                </select>
                                                <small class="text-danger" v-if="errors.supplier_id">
                                                    {{ errors.supplier_id[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <label for="inptSellingPrice">Selling Price</label>
                                                <input v-model="form.selling_price" type="number" min="0" class="form-control" id="inptSellingPrice" aria-describedby="emailHelp" placeholder="Enter Selling Price" />
                                                <small class="text-danger" v-if="errors.selling_price">
                                                    {{ errors.selling_price[0] }}
                                                </small>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <label for="inptBuyingPrice">Buying Price</label>
                                                <input v-model="form.buying_price" type="number" min="0" class="form-control" id="inptBuyingPrice" aria-describedby="emailHelp" placeholder="Enter Buying Price" />
                                                <small class="text-danger" v-if="errors.buying_price">
                                                    {{ errors.buying_price[0] }}
                                                </small>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                                <label for="inptQuantity">Quantity</label>
                                                <input v-model="form.product_quantity" type="number" min="0" class="form-control" id="inptQuantity" aria-describedby="emailHelp" placeholder="Enter Product Quantity" />
                                                <small class="text-danger" v-if="errors.product_quantity">
                                                    {{ errors.product_quantity[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="inptBuyingDate">Buying Date</label>
                                                <input v-model="form.buying_date" type="date" class="form-control" id="inptBuyingDate" aria-describedby="emailHelp" />
                                                <small class="text-danger" v-if="errors.buying_date">
                                                    {{ errors.buying_date[0] }}
                                                </small>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="inputRoot">Root</label>
                                                <input v-model="form.root" type="text" class="form-control" id="inputRoot" aria-describedby="emailHelp" placeholder="Enter Product Root" />
                                                <small class="text-danger" v-if="errors.root">
                                                    {{ errors.root[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <div class="custom-file">
                                                    <input @change="onImageSelected" type="file" class="custom-file-input" id="customFile" />
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <img v-if="form.image != null" :src="form.image" alt="photo" style="height: 40px; width: 40px" />
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
    name: "EditProdcut",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getProduct();
        this.getCategories();
        this.getSuppliers();
    },
    data() {
        return {
            form: {
                name: '',
                code: '',
                root: '',
                selling_price: '',
                buying_price: '',
                buying_date: '',
                product_quantity: '',
                category_id: '',
                supplier_id: '',
                image: '',
                newimage: '',
            },
            categories: [],
            suppliers: [],
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
        getCategories() {
            axios.get("/api/categories").then((response) => {
                this.categories = response.data;
            });
        },
        getSuppliers() {
            axios.get("/api/suppliers").then((response) => {
                this.suppliers = response.data;
            });
        },
        onImageSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.imageValidation();
            } else {
                let reader = new FileReader();
                reader.onload = (event) => {
                    this.form.newimage = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        updateProduct() {
        
            let id = this.$route.params.id;
            axios
                .patch("/api/products/" + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: "all-products",
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
