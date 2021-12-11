<template>
  <v-app id="inspire">
    <v-system-bar app>
      <v-spacer></v-spacer>

      <v-list-item>
        <!-- <v-list-item-icon> -->
         <a :href="link_home">HOMEへ戻る</a>
        <!-- </v-list-item-icon> -->
      </v-list-item>
      
    </v-system-bar>

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
  props:['BackToHome'],
  data: () => ({
    drawer: null,
    link_home: "/",
  }),
  components:{
      Menu,
      Contents,
  },
};

</script>