<template>
    <div class="planComponent">        
        <!-- 検索条件コンポーネント -->
        <v-container mb-3>
            <v-btn
                color="primary"
                elevation="2"
            >検索条件</v-btn>
        </v-container>
        <v-container mb-3>
            <Search />
        </v-container>

        <v-btn
            color="primary"
            elevation="2"
            v-on:click="$store.state.planCreateFlag = true"
        >結果表示
        </v-btn>

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
    components: {
        Search,
        Result,
    },
    data() {
        return {
            resultContainer: false
        }
    },
    methods: {
        spotRead() {
            this.$store.commit('spotRead');
        },
    },
    mounted() {
        this.spotRead();
    },
};

</script>
<style lang="scss" scoped>

</style>