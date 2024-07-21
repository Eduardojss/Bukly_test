<template>
  <v-container>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-card>
        <v-card-title class="headline">Hotel Registration</v-card-title>

        <v-card-subtitle>
          <v-alert type="error" v-if="errorMessage">{{ errorMessage }}</v-alert>
        </v-card-subtitle>

        <v-card-text>
          <v-text-field
            v-model="hotel.name"
            :rules="[rules.required]"
            label="Hotel Name"
            required
          />
          <v-text-field
            v-model="zip_code"
            :rules="[rules.required]"
            label="zip_code"
            required
            @blur="fetchAddress"
          />

          <v-text-field
            v-model="hotel.address"
            :rules="[rules.required]"
            label="Address"
            readonly
          />

          <v-text-field
            v-model="hotel.city"
            :rules="[rules.required]"
            label="City"
            readonly
          />

          <v-text-field
            v-model="hotel.state"
            :rules="[rules.required]"
            label="State"
            readonly
          />

          <v-text-field
            v-model="hotel.website"
            :rules="[rules.required]"
            label="WebSite"
            required
          />
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="submit" color="primary">Cadastrar</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      valid: true,
      errorMessage: "",
      hotel: {
        name: "",
        address: "",
        city: "",
        state: "",
        website: "",
        zip_code: ""
      },
      zip_code: "",
      rules: {
        required: (value) => !!value || "Campo obrigatório.",
      },
    };
  },
  methods: {
    fetchAddress() {
      if (!this.zip_code) return;

      console.log(213);
      const url = `https://viacep.com.br/ws/${this.zip_code}/json/`;
      axios.get(url).then((resp) => {
        const data = resp.data;

        if (data.erro) {
          this.errorMessage = "invalid zip_code.";
        } else {
          this.hotel.address = data.logradouro;
          this.hotel.city = data.localidade;
          this.hotel.state = data.uf;
          this.hotel.zip_code = this.zip_code;
        }
      });
      this.errorMessage = "";
    },
    submit() {
      if (this.$refs.form.validate()) {
        axios.post('api/hotels', this.hotel).then(resp => {
            console.log("Hotel cadastrado:", this.hotel);
            console.log(resp);
            this.$inertia.visit("/");
        }).catch(error => {
            this.errorMessage = error.response.data.message;
            console.log(error);
        });
      } else {
        this.errorMessage = "Por favor, preencha todos os campos obrigatórios.";
      }
    },
  },
};
</script>

<style scoped>
.v-card {
  max-width: 600px;
  margin: 0 auto;
}
</style>