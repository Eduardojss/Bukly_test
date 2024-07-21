<template>
  <!-- Hotel Room Card-->
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <img
      src="https://via.placeholder.com/600x400"
      alt="Hotel Room 1"
      class="w-full h-64 object-cover"
    />
    <div class="p-4">
      <h2 class="text-xl font-semibold mb-2">{{ room.name }}</h2>
      <p class="text-gray-600 mb-4">{{ truncatedDescription }}</p>
      <div class="flex justify-between items-center">
        <span class="text-gray-800 font-semibold">$200/night</span>
        <div v-if="createdBy">
          <a
            @click="editRoom"
            class="bg-blue-800 text-white px-4 py-2 rounded-full uppercase text-xs font-semibold hover:bg-gray-700 transition duration-300"
            >Edit</a
          >
          <a
            @click="deleteRoom"
            class="bg-red-600 text-white px-4 py-2 rounded-full uppercase text-xs font-semibold hover:bg-gray-700 transition duration-300"
            >Delete</a
          >
        </div>
        <a
          class="bg-gray-800 text-white px-4 py-2 rounded-full uppercase text-xs font-semibold hover:bg-gray-700 transition duration-300"
          >Book Now</a
        >
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      createdBy: false,
      id: null,
    };
  },
  props: {
    room: Object,
  },
  computed: {
    truncatedDescription() {
      if (this.room.description.length > 100) {
        return this.room.description.substring(0, 100) + "...";
      } else {
        return this.room.description;
      }
    },
    matchCreator() {
      axios.get("api/hotels/" + this.room.hotel_id).then((response) => {
        this.id = response.data.data.user_id;
        if (this.$store.state.user.id == this.id) {
          this.createdBy = true;
          return;
        }
      });
    },
  },
  mounted() {
    this.matchCreator;
  },
  created() {},
  methods: {
    editRoom() {
      this.$inertia.visit("/rooms/" + this.room.id + "/edit");
    },
    deleteRoom() {
      const userConfirmed = window.confirm("Are you sure you want to delete?");
      if (userConfirmed) {
        axios
        .delete("api/rooms/" + this.room.id)
        .then((response) => {
          console.log(response);
          //this.$inertia.visit("/");
        })
        .catch((error) => {
          console.log(error);
        });
      }
    },
  },
};
</script>