import { createStore } from "vuex";

export default createStore({
    state: {
      user:{
        name: null,
        email: null,
      },
      showLogin: true,
    },
    mutations: {
      logged(state, logged){
        state.showLogin = logged;
      },
    },
    actions: {
    },
    modules: {}
})