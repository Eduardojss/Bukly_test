<template>
  <v-container>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-card>
        <v-card-title class="headline">Room Registration</v-card-title>

        <v-card-subtitle>
          <v-alert type="error" v-if="errorMessage">{{ errorMessage }}</v-alert>
        </v-card-subtitle>
        <v-card-text>
          <v-select
            v-model="selectedHotel"
            :rules="[rules.required]"
            :items="hotelArray"
            item-title="name"
            item-value="id"
            label="Hotel"
            required
          />

          <v-text-field
            v-model="room.name"
            :rules="[rules.required]"
            label="Name"
            required
          />
          <v-textarea
            v-model="room.description"
            :rules="[rules.required]"
            label="Description"
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
      room: {
        name: "",
        description: "",
      },
      hotels: [],
      hotelArray: [],
      selectedHotel: "",
      rules: {
        required: (value) => !!value || "Campo obrigatório.",
      },
    };
  },
  computed: {
    fetchUserHotels() {
      axios
        .get("api/hotels")
        .then((resp) => {
          this.hotels = resp.data.data;
          this.formatHotelNames();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.fetchUserHotels;
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        axios
          .post("api/"+ this.selectedHotel +"/rooms", this.room)
          .then((resp) => {
            console.log("Hotel cadastrado:", this.hotel);
            console.log(resp);
            this.$inertia.visit("/");
          })
          .catch((error) => {
            this.errorMessage = error.response.data.message;
            console.log(error);
          });
      } else {
        this.errorMessage = "Por favor, preencha todos os campos obrigatórios.";
      }
    },
    formatHotelNames() {
      this.hotels.forEach((element) => {
        this.hotelArray = [
          ...this.hotelArray,
          { id: element.id, name: element.name },
        ];
      });
    },
  },
};
</script>
