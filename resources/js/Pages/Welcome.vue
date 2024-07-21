<template>
  <v-app>
    <!-- Navbar -->
    <v-app-bar>
      <v-container>
        <v-row align="center" justify="space-between">
          <!-- Logo -->
          <v-col class="d-flex align-center">
            <v-btn text href="/">HOTELS</v-btn>
          </v-col>
          <!-- Navbar links -->
          <v-col class="d-flex justify-end">
            <v-btn
              v-if="$store.state.showLogin"
              href="/login"
              text
              class="grey--text text--lighten-3"
              @mouseover="hover = true"
              @mouseleave="hover = false"
            >
              Login
            </v-btn>
            <v-btn
              v-if="$store.state.showLogin"
              href="/register"
              text
              class="grey--text text--lighten-3"
              @mouseover="hover = true"
              @mouseleave="hover = false"
            >
              Register
            </v-btn>
            <div v-else>
              <v-btn
                href="#"
                text
                class="grey--text text--lighten-3"
                @click="logout"
                @mouseover="hover = true"
                @mouseleave="hover = false"
              >
                Logout
              </v-btn>
              <v-menu>
                <template v-slot:activator="{ props }">
                  <v-btn v-bind="props" icon>
                    <v-icon>mdi-chevron-down</v-icon>
                  </v-btn>
                </template>
                <v-list>
                  <v-list-item>
                    <v-btn
                      href="/hotels/create"
                      text
                      class="w-full"
                      @mouseover="hover = true"
                      @mouseleave="hover = false"
                    >
                      Register Hotel
                    </v-btn>
                  </v-list-item>
                  <v-list-item>
                    <v-btn
                      href="/hotels/edit"
                      text
                      class="w-full"
                      @mouseover="hover = true"
                      @mouseleave="hover = false"
                    >
                      Edit Hotels
                    </v-btn>
                  </v-list-item>
                  <v-list-item>
                    <v-btn
                      href="/rooms/create"
                      text
                      class="w-full"
                      @mouseover="hover = true"
                      @mouseleave="hover = false"
                    >
                      Add Room
                    </v-btn>
                  </v-list-item>
                </v-list>
              </v-menu>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>

    <!-- Hero Section -->
    <v-parallax
      src="https://images8.alphacoders.com/283/283327.jpg"
      height="500"
    >
      <v-row class="fill-height" align="center" justify="center" text-center>
        <div
          class="bg-gray p-10 px-20 rounded-lg text-center"
          style="backdrop-filter: blur(10px)"
        >
          <h1 class="text-h3 font-weight-bold">Find Your Perfect Hotel</h1>
          <p class="headline mb-6">
            Compare prices from different websites and find the best deals.
          </p>
          <p>
            {{ this.$store.hotelsIds }}
          </p>
        </div>
      </v-row>
    </v-parallax>

    <!-- Hotel Rooms Section -->
    <v-container class="my-12">
      <v-row>
        <v-col cols="12" sm="6" md="4" v-for="room in rooms" :key="room.id">
          <Room :room="room" />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import { mapState } from "vuex";
import Room from "../Components/Room.vue";

export default {
  data() {
    return {
      page: 1,
    };
  },
  components: {
    Room,
  },
  computed: {
    ...mapState(["rooms"]),
    ...mapState(["roomsMeta"]),
  },
  created() {
    this.$store.dispatch("fetchRooms", this.page);
  },
  methods: {
    goToRegisterProduct() {
      this.$inertia.visit("/room/register");
    },
    logout() {
      axios.post("api/logout").then((response) => {
        localStorage.removeItem("token");
        this.$store.commit("logged", true);
        this.$inertia.visit("/");
        location.reload();
      });
    },
  },
};
</script>
