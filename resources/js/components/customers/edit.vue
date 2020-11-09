<template>
<div>
    <div class="text-right">
        <router-link to="/custmers/index" class="btn btn-primary">All Customers</router-link>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Edit Customer</h1>
                                </div>
                                <form @submit.prevent="updateCustomer" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="exampleInputName">Name</label>
                                                <input v-model="form.name" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="Enter Full Name" />
                                                <small class="text-danger" v-if="errors.name">
                                                    {{ errors.name[0] }}
                                                </small>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="exampleInputEmail"> Email</label>
                                                <input v-model="form.email" type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address" />
                                                <small class="text-danger" v-if="errors.email">
                                                    {{ errors.email[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="exampleInputPhone">Phone</label>
                                                <input v-model="form.phone" type="text" class="form-control" id="exampleInputPhone" aria-describedby="emailHelp" placeholder="Enter Phone Number" />
                                                <small class="text-danger" v-if="errors.phone">
                                                    {{ errors.phone[0] }}
                                                </small>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="exampleInputAddress"> Address</label>
                                                <input v-model="form.address" type="text" class="form-control" id="exampleInputAddress" aria-describedby="emailHelp" placeholder="Enter Address" />
                                                <small class="text-danger" v-if="errors.address">
                                                    {{ errors.address[0] }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="customFile">Photo</label>
                                                <div class="custom-file">
                                                    <input @change="onImageSelected" type="file" class="custom-file-input" id="customFile" />
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div v-if="form.photo != null" class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <label for="chosenImage">Chosen Photo</label><br>
                                                <img :src="form.photo" alt="photo" id="chosenImage" style="height: 40px; width: 40px" />
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
    name: 'EditCustomer',
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/",
            });
        }

        this.getCustomer();
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                address: '',
                phone: '',
                photo: '',
                newphoto: '',
            },
            errors: {},
        };
    },
    methods: {
        getCustomer() {
            let customerId = this.$route.params.id;
            axios
                .get(`/api/customers/${customerId}`)
                .then(({
                    data
                }) => {
                    this.form = data;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    Notification.error();
                });
        },
        onImageSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.imageValidation();
            } else {
                let reader = new FileReader();
                reader.onload = (event) => {
                    this.form.newphoto = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        updateCustomer() {
            let id = this.$route.params.id
            axios.patch('/api/customers/' + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: 'all-customers'
                    })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    },
}
</script>

<style scoped>

</style>
