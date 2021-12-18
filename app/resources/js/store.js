import axios from 'axios';
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    tags: [],
    spots: [],
    routes: [],
    tours: [],
    spotTags: [],
    

    planCreateFlag: '',
    successShow:false,
    
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
    readSpotTags(state, payload) {
      state.spotTags = payload;
    },
    readSpots(state, payload) {
      state.spots = payload;
    },
    saveRoutes(state, payload) {
      state.routes = payload;
    },
    saveUserInfo(state, payload) {
      state.userInformation = payload;
    },
    readTours(state, payload){
      state.tours = payload;
    }
  },

  actions: {
    readTags(context){
      axios.get("/api/tag").then((res) => {
        context.commit('readTags', res.data);
      })
    },
    readSpotTags(context){
      axios.get("/api/spotTag").then((res) => {
        context.commit('readSpotTags', res.data);
      })
    },
    readSpots(context){
      axios.get("/api/spot").then((res) => {
        context.commit('readSpots', res.data);
      })
    },
    readTours(context){
      const params={
        "user_id" :this.state.userInformation.id
      };
      axios.get("/api/tour",{params}).then((res) => {
        context.commit('readTours', res.data);
      })
    }
  },
  modules: {


  }
})
