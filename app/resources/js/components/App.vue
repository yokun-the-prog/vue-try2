<template>
  <v-app id="inspire">
    <v-app-bar
        app
        color="gray lighten-3"
        flat
        class="mb-3"
    >
      <v-container
        class="py-0 fill-height"
      >
        <a href="/">
          <v-btn
            color="gray lighten-3"
            class="mr-3"
            depressed
          >HOME
          </v-btn>
        </a>
        <!-- <a href="/logout">
          <v-btn
            color="gray lighten-3"
            class="mr-3"
            depressed
          >LOGOUT
          </v-btn>
        </a> -->
        <!-- <a href="/api/logout"> -->
          <!-- <v-btn
            color="gray lighten-3"
            class="mr-3"
            depressed
            @click="logout()"
          >
            LOGOUT
          </v-btn> -->

      </v-container>
    </v-app-bar>

    <!-- <v-system-bar app>
      <v-spacer></v-spacer>

      <v-list-item>

      </v-list-item>



        <v-btn
          color="primary btn-danger"
          elevation="2"
          v-on:click="this.logout"
        >ログアウト
        </v-btn>
    </v-system-bar> -->

    <!-- メニューコンポーネント -->
    <Menu />

    <!-- コンテンツコンポーネント -->
    <Contents />
  </v-app>

  
</template>

<script>

import Menu from './Menu.vue';
import Contents from './Contents.vue';


export default {
  data() {
    return {
      drawer: null,
      link_home: "/",
      link_logout: "/api/logout",
    };
  },
  components:{
      Menu,
      Contents,
  },
  // laravelからデータの受け取り
  props: ["user_info"],

  methods: {
    readTags() {
      this.$store.dispatch('readTags');
    },
    readSpots() {
      this.$store.dispatch('readSpots');
    },
    saveUserInfo() {
      this.$store.commit('saveUserInfo', this.user_info);
    },

    logout(){
      axios.post("/api/logout")
        .then((response)=>{
          console.log(response);
          console.log('hres');
        })
        .catch((error)=>{
          console.log('エラーです');
        });


      // var url= "/api/logout";
      // axios
      //   .post("/api/logout")
      //   .then(response => {
      //     console.log('成功');
      //   })
      //   .catch(error => {
      //     console.log('ログアウト失敗');
      //   });
    }
  },
  mounted() {
      this.readTags();
      this.readSpots();
      console.log('値渡しの結果'+this.username);
      this.saveUserInfo();
  },
};

</script>
<style scoped>
  a{
    text-decoration: none;
  }
</style>