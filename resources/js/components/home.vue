<template>
<div>

    <h1>home</h1>

</div>
</template>

<script>
export default {
    name: "home",
    created() {
        if (!User.loggedIn()) {
            this.$router.push({
                name: "/"
            });
        }
    },
};
</script>

<style scoped>
</style>
