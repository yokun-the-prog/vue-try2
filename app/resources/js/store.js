import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    tags: [],
    spots: [],
    routes: [],
    planCreateFlag: '',
    
    
    schedule: "",//(parseISO(new Date().toISOString()), 'yyyy-MM-dd'),
    departureSpot: "豊橋駅",
    returnSpot: "二川駅",
    departureTime: "6:30",
    returnTime: "18:30",
    timeToGoHome: "12:00",
    userInformation: [],


  },
  mutations: {
    readTags(state, payload) {
      state.tags = payload;
    },
    readSpots(state, payload) {
      state.spots = payload;
    },
    saveRoutes(state, payload) {
      console.log('payload');
      console.log(payload);
      state.routes = payload;
    },
    saveUserInfo(state, payload) {
      console.log('ユーザー情報更新中');
      state.userInformation = payload;
    },
  },
  // getters:{
  //   averageTerm: state =>{
  //     let sum = 0;
  //     spots->standard_term
  //   }
  // },

  actions: {
    readTags(context){
      axios.get("/api/tag").then((res) => {
        context.commit('readTags', res.data);
      })
    },
    readSpots(context){
      axios.get("/api/spot").then((res) => {
        context.commit('readSpots', res.data);
      })
    },


  },
  modules: {


  }
})
