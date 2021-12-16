<template>
    <div class="historyComponent">
        
        <v-data-table
            :headers="headers"
            :items="histories"
            item-key="id"
            class="elevation-1"
            hide-default-footer

        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title depressed>{{$store.state.userInformation.name}}さんの旅の履歴</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog
                        max-width="500px"
                    >
                        <template v-slot:activator="{  }">
                            <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                :to= "to"
                                link
                            >新規追加
                            </v-btn>
                        </template>
                    </v-dialog>


                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="text-h5">この旅を削除しますか？</v-card-title>
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
            <template v-slot:item.action="{ item }">

                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>

        <!-- <div>
            <v-data-table
            :headers="headers"
            :items="histories"
            item-key="id"
            class="elevation-1"
            hide-default-footer
            >
            </v-data-table>
        </div> -->
        </v-data-table>

    </div>

</template>


<script>
  export default {
    data () {
        return {
            dialog:false,
            dialogDelete: false,

            to:"/plan",
            histories: [
                {
                    id:'1',
                    date: '2019.12.14',
                    depTime: null,
                    retTime: null,
                    spots: 'あああ',
                },
                {
                    id:'2',
                    date: '2019.12.31',
                    depTime: null,
                    retTime: null,
                    spots: 'あああ',
                },
                {
                    id:'3',
                    date: null,
                    depTime: null,
                    retTime: null,
                    spots: 'あああ',
                },
                {
                    id:'4',
                    date: null,
                    depTime: null,
                    retTime: null,
                    spots: 'あああ',
                },
                {
                    id:'5',
                    date: null,
                    depTime: null,
                    retTime: null,
                    spots: 'あああ',
                },
            ],
            editedIndex: -1,
            editedItem: {
                id:'',
                date: '',
                depTime: '',
                retTime: '',
                spots: '',
            },

            defaultItem: {
                id:'',
                date: '',
                depTime: '',
                retTime: '',
                spots: '',
            },

        }
    },
    computed: {
      headers () {
        return [
          { text: '登録日', value: 'date' },
          { text: '出発時刻', value: 'depTime', sortable: false },
          { text: '帰宅時刻', value: 'retTime', sortable: false },
          { text: '目的地一覧', value: 'spots', sortable: false },
          { text: 'アクション', value: 'action', sortable: false },
        ]
      },
    },
    methods: {



        editItem (item) {
            this.editedIndex = this.histories.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
            console.log('削除');
            this.editedIndex = this.histories.indexOf(item)
            console.log(this.editedIndex);

            this.editedItem = Object.assign({}, item)
            console.log(this.editedItem);
            this.dialogDelete = true
            console.log('削除');
        },

        deleteItemConfirm () {
            this.histories.splice(this.editedIndex, 1)
            this.closeDelete()
        },


        close () {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save () {
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem)
            } else {
                this.desserts.push(this.editedItem)
            }
            this.close()
        },
    //   filterOnlyCapsText (value, search, item) {
    //     return value != null &&
    //       search != null &&
    //       typeof value === 'string' &&
    //       value.toString().toLocaleUpperCase().indexOf(search) !== -1
    //   },
    },
}
</script>

<style lang="scss" scoped>
    .card {
        margin-bottom: 5px;
    }
</style>

