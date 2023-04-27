import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    msg: "Use this application to keep track of your inventory. Once you log in you will have access to change your inventory.",
    inventory: [],
    auth: false,
    session: "",
    user: {
      fname: "",
      lname: "",
      email: "",
      id: null
    }
  },
  mutations: {
    setAuth: function(state, payload) {
      state.auth = payload.auth;
      state.session = payload.session;
    },
    setUser: function(state, payload) {
      state.user.fname = payload.fname;
      state.user.lname = payload.lname;
      state.user.email = payload.email;
      state.user.id = payload.id;
    }
  },
  modules: {
  }
})
