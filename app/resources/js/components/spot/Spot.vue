<template>
    <div class="spotComponent">
        <v-container mb-3>
            観光スポット一覧
        </v-container>
        
        <v-card>
            <v-row>
                <v-col>
                    <v-text-field
                        v-model="message"
                        label="目的地を入力してください"
                        type="text"
                    ></v-text-field>
                </v-col>
                <v-col>
                    <v-btn color="primary">検索</v-btn>
                </v-col>
            </v-row>
        </v-card>
        <v-card>
            <v-chip-group
                multiple
                active-class="primary--text"
            >
                <v-chip
                    v-for="tag in $store.state.tags"
                    v-bind:key="tag.name"
                >
                    {{ tag.name }}
                </v-chip>
            </v-chip-group>
        </v-card>
        
        <v-col
            class="grey lighten-5"
            v-for="spot in $store.state.spots"
            v-bind:key="spot.name"
        >
            <v-card
                :loading="loading"
                class="card"
                elevation="3"
                outlined
            >
                <v-card-title>{{ spot.name }}</v-card-title>
                <v-card-subtitle>食事処</v-card-subtitle>
                <v-card-text>
                    <div>所在地：{{ spot.address }}</div>
                    <div>TEL：{{ spot.tel }}</div>
                </v-card-text>
                <v-card-actions>
                    <v-btn @click="load" :disabled="loading" v-text="loadLabel"></v-btn>
                </v-card-actions>
            </v-card>

        </v-col>



    </div>

</template>


<script>

export default {
    data() {
        return {
            message: "",
            load: null,
            loadLabel: null,
            loading: null,
        };
    },
    methods: {
        tagRead() {
            this.$store.commit('tagRead');
        },
        spotRead() {
            this.$store.commit('spotRead');
        },
    },
    mounted() {
        this.tagRead();
        this.spotRead();
    },
};
</script>

<style lang="scss" scoped>
    .card {
        margin-bottom: 5px;
    }
</style>
