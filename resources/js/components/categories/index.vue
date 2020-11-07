<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Categories</h1>
        <div class="text-right">
            <router-link to="/categories/create" class="btn btn-primary">Add Category</router-link>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Categories List</h6>
                    <div>
                        <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in filterSearch" :key="category.id">
                                <td>{{ category.name }}</td>
                                <td>
                                    <router-link :to="{ name: 'edit-category', params:{id:category.id} }" class="btn btn-sm btn-primary">edit</router-link>
                                    <button @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">
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
    name: 'Categories',
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getCategories();
    },
    data() {
        return {
            categories: [],
            searchKeyword: "",
        };
    },
    computed: {
        filterSearch() {
            return this.categories.filter((category) => {
                return category.name.match(this.searchKeyword);
            });
        },
    },
    methods: {
        getCategories() {
            axios
                .get("/api/categories/")
                .then((response) => {
                    this.categories = response.data;
                })
                .catch();
        },
        deleteCategory(id) {
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
                        .delete(`/api/categories/${id}`)
                        .then(() => {
                            this.categories = this.categories.filter((category) => {
                                return category.id != id;
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
