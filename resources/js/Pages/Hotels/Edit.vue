<template>
  <v-container>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-card>
        <v-card-title class="headline">Edit Hotels</v-card-title>

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
            @blur="fetchHotelData"
          />

          <v-text-field
            v-model="hotel.name"
            label="Hotel Name"
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
            label="WebSite"
          />
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="deleteHotel" color="red">Delete</v-btn>
          <v-btn @click="editHotel" color="primary">Save</v-btn>
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
        zip_code: "",
      },
      hotels: [],
      hotelArray: [],
      selectedHotel: "",
      zip_code: "",
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
    formatHotelNames() {
      this.hotels.forEach((element) => {
        this.hotelArray = [
          ...this.hotelArray,
          { id: element.id, name: element.name },
        ];
      });
    },
    fetchHotelData(){
      axios.get("api/hotels/" + this.selectedHotel).then((resp) => {
        this.hotel = resp.data.data;
      })
    },
    editHotel() {
      axios
        .put("api/hotels/" + this.selectedHotel, this.hotel)
        .then((response) => {
          console.log(response);
          this.$inertia.visit("/");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteHotel() {
      const userConfirmed = window.confirm("Are you sure you want to delete?");
      if (userConfirmed) {
        axios
        .delete("api/hotels/" + this.selectedHotel)
        .then((response) => {
          console.log(response);
          this.$inertia.visit("/");
        })
        .catch((error) => {
          console.log(error);
        });
      }
    },
  },
};
</script>