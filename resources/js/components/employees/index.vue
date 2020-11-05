<template>
  <div>
    <div class="text-right">
      <router-link to="/employees/create" class="btn btn-primary"
        >Add Employee</router-link
      >
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">All Employees</h1>
                  </div>
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
  name: "index",
  created() {
    if (!User.loggedIn()) {
      this.$router.push({
        name: "/",
      });
    }
  },
};
</script>

<style scoped>
</style>