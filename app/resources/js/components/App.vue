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
            class="mr-6"
            depressed
          >HOME
          </v-btn>
        </a>
      <v-alert
        outlined
        type="success"
        text
        v-if="$store.state.successShow === true"

      >
        保存に成功しました。
      </v-alert>

      </v-container>
    </v-app-bar>

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
    readTours(){
      this.$store.dispatch('readTours', this.user_info);
    },

  },
  mounted() {
      this.readTags();
      this.readSpots();
      this.saveUserInfo();
      this.readTours();
  },
};

</script>
<style scoped>
  a{
    text-decoration: none;
  }
</style>