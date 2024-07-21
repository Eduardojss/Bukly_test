<template>
  <div class="container montserrat"></div>
</template>
<script>
export default {
  mounted() {
    axios.get("/api/user").then((response) => {
      this.$store.commit("setUser", response.data.user);
      this.$store.commit("logged", false);
    });
  },
};
</script>
