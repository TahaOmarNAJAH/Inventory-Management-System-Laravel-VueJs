<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Suppliers</h1>
        <div class="text-right">
            <router-link to="/suppliers/create" class="btn btn-primary">Add Supplier</router-link>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Suppliers List</h6>
                    <div>
                        <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Shop Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="supplier in filterSearch" :key="supplier.id">
                                <td>{{ supplier.name }}</td>
                                <td>
                                    <img :src="'/'+supplier.photo" alt="" width="50" height="50" />
                                </td>
                                <td>{{ supplier.phone }}</td>
                                <td>{{ supplier.email }}</td>
                                <td>{{ supplier.shopname }}</td>
                                <td>
                                    <router-link :to="{ name: 'edit-supplier', params:{id:supplier.id} }" class="btn btn-sm btn-primary">edit</router-link>
                                    <button @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">
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
    name: 'Suppliers',
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getSuppliers();
    },
    data() {
        return {
            suppliers: [],
            searchKeyword: "",
        };
    },
    computed: {
        filterSearch() {
            return this.suppliers.filter((supplier) => {
                return supplier.name.match(this.searchKeyword);
            });
        },
    },
    methods: {
        getSuppliers() {
            axios
                .get("/api/suppliers/")
                .then((response) => {
                    this.suppliers = response.data;
                })
                .catch();
        },
        deleteSupplier(id) {
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
                        .delete(`/api/suppliers/${id}`)
                        .then(() => {
                            this.suppliers = this.suppliers.filter((supplier) => {
                                return supplier.id != id;
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
