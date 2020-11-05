<template></template>

<script>
export default {
  name: "logout",
  created() {
    User.logout();
    Toast.fire({
      icon: "success",
      title: "Logout successfully",
    });
    this.$router.push({name:'/'});
  },
};
</script>

<style scoped>
</style>
