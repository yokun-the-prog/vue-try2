<template>
<v-app>
    <v-container>
        <v-card class="mb-4">
            <v-toolbar class="mx-4 mb-1 pb-0 pt-4" flat>
                    <v-text-field
                        v-model="message"
                        label="目的地を入力してください"
                        type="text"
                    ></v-text-field>
                <!-- <v-col>
                    <v-btn color="primary">検索</v-btn>
                </v-col> -->

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
                        検索
                        </v-btn>
                        <div
                            hidden
                        >
                            {{$store.state.tours}}
                        </div>
                    </template>
                </v-dialog>
            </v-toolbar>

            <v-row class="ml-6 pt-0 mb-0 pb-0">
                <v-col cols=1 class="mt-3"><p>タグ:</p></v-col>
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
                class="my-0"
                v-for="spot in $store.state.spots"
                v-bind:key="spot.name"
            >
                <v-card
                    class="card"
                    elevation="3"
                    outlined
                >
                    <v-card-title>{{ spot.name }}</v-card-title>
                    <v-row
                        dense
                    >
                        <v-chip-group
                            class="ma-2 pa-2"
                        >
                            <!-- <v-chip
                                class="ma-2 pa-2"
                                label
                                v-for="tag in this.tagsShow[spot.id]"
                                v-bind:key="tag"
                            >ああ</v-chip> -->
                        
                        </v-chip-group>
                                    
                        <!-- <v-col
                            v-for="tag in $store.state.tags"
                            v-bind:key="tag.id"
                        >
                                    <v-chip-group
                                        class="ma-2 pa-2"
                                        v-for="spotTag in $store.state.spotTags"
                                        v-bind:key="spotTag.id"
                                    >

                                    <v-chip
                                        class="ma-2 pa-2"
                                        label
                                        v-if="(spotTag.spot_id === spot.id ) && (spotTag.tag_id === tag.id )"
                                    >{{tagsShow[0][0]}}</v-chip>
                                    
                                    </v-chip-group>
                                    
                        </v-col> -->
                    </v-row>
                    <div>
                        <v-img max-width="250" :src="`/storage/${spot.photo_path}`"></v-img>
                    </div>
                    <v-card-text>
                        <div>所在地:{{ spot.address }}</div>
                        <div>TEL:{{ spot.tel }}</div>
                    </v-card-text>
                </v-card>

            </v-col>


    </v-container>
</v-app>
</template>


<script>

export default {
    data() {
        return {
            message: "",
            dialog:"",
            to:"",
            // tagsShow:[],
        };
    },
    methods: {
        readTags: function() {
            this.$store.dispatch('readTags','');
        },
        readSpotTags: function(){
            this.$store.dispatch('readSpotTags','');
        },
        readSpots: function() {
            this.$store.dispatch('readSpots','');
        },
        
    },
    mounted() {
        this.readTags();
        this.readSpotTags();
        this.readSpots();
        // this.comboTags();
    },
    computed:{
        // tagsShow: function(){
        //     var large_group=[];
        //     var small_group=[];
        //     this.$store.state.spots.forEach(spot=>{
        //         this.$store.state.tags.forEach(tag=>{
        //             this.$store.state.spotTags.forEach(spotTag=>{
        //                 if(( spotTag.spot_id == spot.id ) && ( spotTag.tag_id == tag.id )){
        //                     small_group.push(tag.name);
        //                 };
        //             });
        //             console.log(small_group);
        //         });
        //         large_group.push(small_group);
        //         small_group=[];

        //     });
        //             console.log(large_group);

        //     return large_group;

        // }

    },
};
</script>

<style lang="scss" scoped>
    .card {
        margin-bottom: 5px;
    }
</style>
