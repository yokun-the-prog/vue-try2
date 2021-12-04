<template>
  <v-app id="inspire">
    <v-system-bar app>
      <!-- <v-spacer></v-spacer> -->

      <!-- <v-icon>mdi-square</v-icon>

      <v-icon>mdi-circle</v-icon>

      <v-icon>mdi-triangle</v-icon> -->
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
  data: () => ({
    drawer: null,
  }),
  components:{
      Menu,
      Contents,
  },
};

</script>