<template>
    <div class="historyComponent">
        検索画面

        <v-col 
            class="grey lighten-5"
            v-for="list in lists"
            v-bind:key="list.name"
        >
            <v-card
                :loading="loading"
                class="card"
                elevation="3"
                outlined
            >
                <v-card-title>{{ list.name }}</v-card-title>
                <v-card-subtitle>食事処</v-card-subtitle>
                <v-card-text>
                    <div>所在地：{{ list.address }}</div>
                    <div>TEL：{{ list.tel }}</div>
                </v-card-text>
                <v-card-actions>
                    <v-btn @click="load" :disabled="loading" v-text="loadLabel"></v-btn>
                </v-card-actions>
            </v-card>

        </v-col>




<!-- 
        <v-card
        elevation="3"
        outlined
        >
            <v-card-title>No.1</v-card-title>
            <v-card-subtitle>card subtitle</v-card-subtitle>
            <v-card-text>
                <div>card text. card text. card text. card text. card text. card text.</div>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="load" :disabled="loading" v-text="loadLabel"></v-btn>
            </v-card-actions>
        </v-card>


        <v-card
        elevation="3"
        outlined
        >
            <v-card-title>No.1</v-card-title>
            <v-card-subtitle>card subtitle</v-card-subtitle>
            <v-card-text>
                <div>card text. card text. card text. card text. card text. card text.</div>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="load" :disabled="loading" v-text="loadLabel"></v-btn>
            </v-card-actions>
        </v-card>



        <v-card
        elevation="3"
        outlined
        >
            <v-card-title>No.1</v-card-title>
            <v-card-subtitle>card subtitle</v-card-subtitle>
            <v-card-text>
                <div>card text. card text. card text. card text. card text. card text.</div>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="load" :disabled="loading" v-text="loadLabel"></v-btn>
            </v-card-actions>
        </v-card>




        <v-card
        elevation="3"
        outlined
        >
            <v-card-title>No.1</v-card-title>
            <v-card-subtitle>card subtitle</v-card-subtitle>
            <v-card-text>
                <div>card text. card text. card text. card text. card text. card text.</div>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="load" :disabled="loading" v-text="loadLabel"></v-btn>
            </v-card-actions>
        </v-card>




        <v-card
        elevation="3"
        outlined
        >
            <v-card-title>魚太郎</v-card-title>
            <v-card-subtitle>card subtitle</v-card-subtitle>
            <v-card-text>
                <div>card text. card text. card text. card text. card text. card text.</div>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="load" :disabled="loading" v-text="loadLabel">URL</v-btn>
            </v-card-actions>
        </v-card>




        <v-card
        elevation="3"
        outlined
        >
            <v-card-title>No.1</v-card-title>
            <v-card-subtitle>card subtitle</v-card-subtitle>
            <v-card-text>
                <div>card text. card text. card text. card text. card text. card text.</div>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="load" :disabled="loading" v-text="loadLabel"></v-btn>
            </v-card-actions>
        </v-card>

 -->





    </div>


    


</template>

<script>
export default {
    data(){
        return{
            lists: [
                {
                    name: "あ",
                    address: "ああ",
                    tel: "あああ",
                },
                {
                    name: "い",
                    address: "いい",
                    tel: "ううう",
                },
                {
                    name: "え",
                    address: "ええ",
                    tel: "えええ",
                },
                {
                    name: "お",
                    address: "おお",
                    tel: "おおお",
                },

            ],
        }
    },
    methods: {

    },
    mounted() {

    },
};
</script>
<style lang="scss" scoped>
    .card {
        margin-bottom: 5px;

    }
</style>

