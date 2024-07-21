<template>
    <div class="container-login shadow p-3 mb-5 flex flex-col items-center">
        <small class="title pb-3 fs-3 text-center">Login</small>
        <div class="grid-cols-1 pb-3">
            <input type="email" class="form-control rounded-pill border border-dark-subtle" id="inputEmail"
                placeholder="E-mail" />
        </div>
        <div class="pb-4">
            <input type="password" class="form-control rounded-pill border border-dark-subtle" id="inputPassword"
                placeholder="Senha" />
        </div>
        <div class="pb-3">
            <button @click="login" class="btn login-button rounded-pill">
                Acessar
            </button>
        </div>
        <div class=" pb-3">
            <p class="fs-6 ps-2">Ainda não possui uma conta?</p>
            <button @click="goToRegister" class="btn login-button rounded-pill">
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
                    this.$router.push({ name: "Home" });
                    this.$store.commit("setUser", response.data.userDetails.user);
                    this.$store.commit("logged", false);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        goToRegister() {
            this.$router.push("/register");
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