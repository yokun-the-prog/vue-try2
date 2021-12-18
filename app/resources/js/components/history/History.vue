
<template>
  <v-data-table
    :headers="headers"
    :items="this.$store.state.tours"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>{{$store.state.userInformation.name}}さんの旅の履歴</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
                :to= "to"
                link
            >
              新しい旅を計画する
            </v-btn>
            <div
                hidden
            >
                {{$store.state.tours}}
            </div>
          </template>

        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this tour?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <!-- <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon> -->
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
  </v-data-table>
</template>


<script>
  export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        to:"/plan",

        headers: [
            { text: '旅予定日', value: 'schedule' },
            { text: '出発時刻', value: 'departure_at', sortable: false },
            { text: '帰宅時刻', value: 'return_at', sortable: false },
            { text: '出発地', value: 'departure_spot', sortable: false },
            { text: '帰宅地', value: 'return_spot', sortable: false },
            { text: '目的地一覧', value: 'allSpots', sortable: false },
            { text: 'アクション', value: 'actions', sortable: false },
        ],

        editedIndex: -1,
        editedItem: {
            id:'',
            schedule: '',
            departure_at: '',
            return_at: '',
            departure_spot: '',
            return_spot: '',
            allSpots: '',
        },

        defaultItem: {
            id:'',
            schedule: '',
            departure_at: '',
            return_at: '',
            departure_spot: '',
            return_spot: '',
            allSpots: '',
        },
    }),

    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
    },

    created () {
    },

    methods: {

        editItem: function(item) {
            this.editedIndex = this.$store.state.tours.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem: function(item) {
            this.editedIndex = this.$store.state.tours.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm: function() {
            this.$store.state.tours.splice(this.editedIndex, 1)
            this.closeDelete()
        },

        close: function() {
            this.dialog = false
            this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
            })
        },

        closeDelete: function() {
            this.dialogDelete = false
            this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
            })
        },

        save: function() {
            if (this.editedIndex > -1) {
            Object.assign(this.$store.state.tours[this.editedIndex], this.editedItem)
            } else {
            this.$store.state.tours.push(this.editedItem)
            }
            this.close()
        },
        readTours: function() {
            this.$store.dispatch('readTours');
        },
    },
    mounted() {
        // this.readTours();
    },
}
</script>

<style lang="scss" scoped>
    .card {
        margin-bottom: 5px;
    }
</style>



