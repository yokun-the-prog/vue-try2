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
            v-on:click="resultContainer = true"
        >結果表示
        </v-btn>

        <!-- 検索結果コンポーネント -->
        <template v-if="resultContainer">
            <v-container
                mb-3
                v-if="resultContainer"
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
            resultContainer: false,
            spots: [],
        };
    },
    methods: {
        spotRead() {
            axios.get("/api/spot").then((res) => {
                this.spots = res.data;
                console.log(this.spots);
            });
        },
    },
    mounted() {
        this.spotRead();
    },
};

</script>
<style lang="scss" scoped>

</style>