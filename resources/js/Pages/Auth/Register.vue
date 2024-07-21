<template>
    <div class="container-login shadow p-3 mb-5 row form-group">
        <small class="title pb-3 fs-3 text-center">Registro</small>
        <div class="row-sm pb-3">
            <input type="text" class="form-control rounded-pill border border-dark-subtle" id="inputName"
                placeholder="Seu Nome" />
        </div>
        <div class="row-sm pb-3">
            <input type="email" class="form-control rounded-pill border border-dark-subtle" id="inputEmail"
                placeholder="E-mail" />
        </div>
        <div class="row-sm pb-4">
            <input type="password" class="form-control rounded-pill border border-dark-subtle" id="inputPassword"
                placeholder="Senha" />
        </div>
        <div class="row-sm pb-3">
            <button @click="register" class="btn login-button rounded-pill">
                Registrar-se
            </button>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    methods: {
        register() {
            axios.post("api/register", {
                name: document.getElementById("inputName").value,
                email: document.getElementById("inputEmail").value,
                password: document.getElementById("inputPassword").value,
            }).then((response) => {
                localStorage.setItem("token", response.data.token);
                this.$router.push("/");
            }).catch((error) => {
                console.log(error);
            });
        }
    }
}
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