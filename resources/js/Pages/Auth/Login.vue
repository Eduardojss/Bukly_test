<template>
  <div class="container-login shadow p-3 mb-5 flex flex-col items-center">
    <small class="title pb-3 fs-3 text-center">Login</small>
    <div class="grid-cols-1 pb-3">
      <input
        type="email"
        class="rounded-xl border border-gray-300 p-3 w-full"
        id="inputEmail"
        placeholder="E-mail"
      />
    </div>
    <div class="pb-4">
      <input
        type="password"
        class="rounded-xl border border-gray-300 p-3 w-full"
        id="inputPassword"
        placeholder="Senha"
      />
    </div>
    <div class="pb-3">
      <button
        @click="login"
        class="login-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl"
      >
        Acessar
      </button>
    </div>
    <div class="pb-3">
      <p class="fs-6 ps-2">Ainda não possui uma conta?</p>
      <button
        @click="goToRegister"
        class="login-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl"
      >
        Registrar-se
      </button>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    login() {
      axios
        .post("api/login", {
          email: document.getElementById("inputEmail").value,
          password: document.getElementById("inputPassword").value,
        })
        .then((response) => {
          localStorage.setItem("token", response.data.token);
          this.$store.commit("setUser", response.data.userDetails.user);
          this.$store.commit("logged", false);
          this.$inertia.visit("/");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    goToRegister() {
      this.$inertia.visit("/register");
    },
  },
};
</script>

<style scoped>
body {
  display: flex;
  align-items: center;
  justify-content: center !important;
}

.title {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: #0026fd;
  font-family: "Montserrat", sans-serif;
  font-optical-sizing: auto;
}

.container-login {
  margin-top: 20vh;
  margin-left: auto;
  margin-right: auto;
  max-width: 390px;
}

.login-button {
  color: white;
  background-color: #0026fd;
  width: 100%;
}
</style>