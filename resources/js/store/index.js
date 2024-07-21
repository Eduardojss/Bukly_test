import { createStore, Store } from "vuex";
import createPersistedState from 'vuex-persistedstate';

export default createStore({
    state: {
      user:{
        name: null,
        email: null,
      },
      showLogin: true,
      rooms: null,
      hotelsIds: [],
      roomsMeta: null,
    },
    mutations: {
      setUser(state, user){
        state.user = user;
      },
      logged(state, logged){
        state.showLogin = logged;
        console.log(logged);
      },
      setRooms(state, rooms){
        state.rooms = rooms;
      },
      setRoomsPaginationMeta(state, meta){
        state.roomsMeta = meta;
      },
    },
    actions: {
      fetchRooms({ commit }, page) {
        if(!page) page = 1 ;
        axios.get('/api/rooms?page=' + page)
        .then(response => {
          commit('setRooms', response.data.data);
          commit('setRoomsPaginationMeta', response.data.meta);
        });
      },
    },
    modules: {},
    plugins: [createPersistedState()],
})