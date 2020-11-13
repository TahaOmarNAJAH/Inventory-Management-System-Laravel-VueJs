<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Orders</h1>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
                    <div>
                        <input v-model="searchKeyword" class="form-control form-control-sm" type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Customer Name</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Total</th>
                                <th>Pay by</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in orders" :key="order.id">
                                <td>{{ order.customer_name }}</td>
                                <td>{{ order.paid }}</td>
                                <td>{{ order.due }}</td>
                                <td>{{ order.total }}</td>
                                <td>{{ order.pay_by }}</td>
                                <td>{{ order.date }}</td>
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
    name: 'Orders',
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }
        this.getOrders();
    },
    data() {
        return {
            orders: [],
            searchKeyword: "",
        };
    },
    computed: {
        filterSearch() {
            return this.orders.filter((order) => {
                return order.paid.match(this.searchKeyword);
            });
        },
    },
    methods: {
        getOrders() {
            axios
                .get("/api/orders")
                .then((response) => {
                    this.orders = response.data.data;
                })
                .catch();
        },
    },
}
</script>

<style scoped>

</style>
