import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    tags: [],
    spots: [],
    planCreateFlag: '',

  },
  mutations: {
    tagRead(state) {
      axios.get("/api/tag").then((res) => {
          state.tags = res.data;
      });
    },
    spotRead(state) {
      axios.get("/api/spot").then((res) => {
          state.spots = res.data;
      });
    },
  },
  // getters:{
  //   averageTerm: state =>{
  //     let sum = 0;
  //     spots->standard_term
  //   }
  // },

  actions: {


  },
  modules: {


  }
})
