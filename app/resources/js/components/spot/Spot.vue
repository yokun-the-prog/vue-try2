<template>
    <div class="spotComponent">

        <v-card>
            <v-row class="mx-4 mb-1 pb-0">
                <v-col cols=8>
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
            <v-row class="ml-4 pt-0">
                <v-col cols=1><p>タグ：</p></v-col>
                <v-col cols=11>
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
                </v-col>
            </v-row>
        </v-card>
        
        <v-col
            class="grey lighten-5"
            v-for="spot in $store.state.spots"
            v-bind:key="spot.name"
        >
            <v-card
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
            </v-card>

        </v-col>



    </div>

</template>


<script>

export default {
    data() {
        return {
            message: "",
        };
    },
    methods: {
        readTags: function() {
            this.$store.dispatch('readTags','');
        },
        readSpots: function() {
            this.$store.dispatch('readSpots','');
        },
    },
    mounted() {
        this.readTags();
        this.readSpots();
    },
};
</script>

<style lang="scss" scoped>
    .card {
        margin-bottom: 5px;
    }
</style>
