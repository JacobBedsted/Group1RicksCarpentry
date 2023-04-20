import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    msg: "Use this application to keep track of your inventory. Once you log in you will have access to change your inventory.",
    inventory: [],
    auth: false,
    username: ""
  },
  getters: {
    deansList: function(state) {
      return state.newStudents.filter(function(newStudent){
          return newStudent.GPA > 3.5;
      });
    },
    deansListCount: function(state,getters) {
      return getters.deansList.length;
    }
  },
  mutations: {
    addStudent: function(state, payload) {
      state.newStudents.push(Object.assign({}, payload));
    },
    clearStudents: function(state) {
      state.newStudents = []
    }
  },
  actions: {
    clearStudents: function(context) {
      context.commit("clearStudents");
    }
  },
  modules: {
  }
})
