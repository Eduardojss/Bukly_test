<template>
  <div class="container-login shadow p-3 mb-5 flex flex-col items-center">
    <small class="title pb-3 fs-3 text-center">Registro</small>
    <div class="grid-cols-1 pb-3">
      <input
        type="text"
        class="rounded-xl border border-gray-300 p-3 w-full"
        id="inputName"
        placeholder="Seu Nome"
      />
    </div>
    <div class="row-sm pb-3">
      <input
        type="email"
        class="rounded-xl border border-gray-300 p-3 w-full"
        id="inputEmail"
        placeholder="E-mail"
      />
    </div>
    <div class="row-sm pb-4">
      <input
        type="password"
        class="rounded-xl border border-gray-300 p-3 w-full"
        id="inputPassword"
        placeholder="Senha"
      />
    </div>
    <div class="row-sm pb-3">
      <button
        @click="register"
        class="login-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl"
      >
        Registrar-se
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  methods: {
    register() {
      axios
        .post("api/register", {
          name: document.getElementById("inputName").value,
          email: document.getElementById("inputEmail").value,
          password: document.getElementById("inputPassword").value,
        })
        .then((response) => {
          localStorage.setItem("token", response.data.token);
          this.$store.commit("logged", false);
          this.$inertia.visit("/");
        })
        .catch((error) => {
          console.log(error);
        });
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