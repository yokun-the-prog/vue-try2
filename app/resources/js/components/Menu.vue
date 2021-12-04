<template>
    
  <v-navigation-drawer
    v-model="drawer"
    app
  >
    <v-sheet
      color="grey lighten-4"
      class="pa-4"
    >
      <v-avatar
        class="mb-4"
        color="grey darken-1"
        size="64"
      ></v-avatar>

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
      ["mdi-inbox-arrow-down", "見どころ紹介", "/spot"],
      ["mdi-send", "旅の計画", "/plan"],
      ["mdi-delete", "旅の履歴", "/history"],
      ["mdi-alert-octagon", "口コミ投稿", "/board"],
    ],
  }),
};

</script>