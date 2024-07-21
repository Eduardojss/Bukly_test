<template>
  <v-container>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-card>
        <v-card-title class="headline">Room Registration</v-card-title>

        <v-card-subtitle>
          <v-alert type="error" v-if="errorMessage">{{ errorMessage }}</v-alert>
        </v-card-subtitle>
        <v-card-text>
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
          <v-btn @click="submit" color="primary">Save</v-btn>
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
      rules: {
        required: (value) => !!value || "Campo obrigatório.",
      },
    };
  },
  props: {
    room_id: {
        type: String,
        default: ''
    }  
  },
  computed: {
  },
  mounted() {
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        axios
          .put("api/rooms/" + this.$page.props.room_id, this.room)
          .then((resp) => {
            console.log("Quart cadastrado:");
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
  },
};
</script>
