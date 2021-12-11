<template>
    <!-- v-model="drawer" -->
    <!-- expand-on-hover -->
    
  <v-navigation-drawer
    app
  >
    <v-sheet
      color="grey lighten-4"
      class="pa-4"
    >
      <v-avatar color="indigo">
        <v-icon dark>
          mdi-account-circle
        </v-icon>
      </v-avatar>
      <div>john@vuetifyjs.com</div>
    </v-sheet>


    <v-list>
      <v-list-item
        v-for="[icon, text, to] in links"
        :key="icon"
        :to= "to"
        link
      >
        <v-list-item-icon>
          <v-icon>{{ icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>{{ text }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>

export default {
  
  data: () => ({
    drawer: "",
    links: [
      ["mdi-map-marker-outline", "見どころ紹介", "/spot"],
      ["mdi-chart-timeline-variant", "旅の計画", "/plan"],
      ["mdi-folder", "旅の履歴", "/history"],
      ["mdi-comment-processing", "口コミ投稿（作成中）", "/board"],
    ],
  }),
};

</script>