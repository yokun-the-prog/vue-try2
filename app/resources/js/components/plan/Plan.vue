<template>
    <div class="planComponent">        
        <!-- 検索条件コンポーネント -->

            <v-toolbar
                flat
            >
                <v-toolbar-title>新しい旅の計画</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>


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

        <v-container mb-3 px-4>
            <Search />
        </v-container>

        <!-- <v-btn
            color="primary"
            elevation="2"
        >結果表示
        </v-btn> -->

        <!-- 検索結果コンポーネント -->
        <template v-if="$store.state.planCreateFlag">
            <v-container
                mb-3
            >
                <v-btn
                    color="primary"
                    elevation="2"
                >検索結果</v-btn>
            </v-container>
            <v-container>
                <Result />

                <!-- <Result :spots="spots2Child" />
                                <Result :spots="spots2Child" /> -->
            </v-container>
        </template>
    </div>

</template>

<script>
import Search from './Search.vue';
import Result from './Result.vue';
export default {
    data() {
        return {
            // 使わないが、画面遷移の間で参照できずエラーになるため変数として宣言しておく
            dialogDelete: false,
            closeDelete: false,
            deleteItemConfirm: false,
        }
    },
    components: {
        Search,
        Result,
    },

    methods: {
        readSpots: function() {
            this.$store.dispatch('readSpots');
        },
        
    },
    mounted() {
        this.readSpots();
    },
};

</script>
<style lang="scss" scoped>

</style>