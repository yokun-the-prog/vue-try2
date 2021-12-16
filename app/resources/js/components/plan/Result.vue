<template>

    <div>        
    <v-container>

        <v-row>
            <!-- 左半分 -->
            <!-- 出発地 -->
            <v-col cols=12>
                <v-card
                    class="card"
                    elevation="3"
                    outlined
                > 
                    <v-row>   
                        <!-- <v-col cols=2>
                            <br>
                        </v-col> -->
                        
                        <!-- データの枠組み -->
                        <v-col>
                            <v-card-subtitle class="text-center">{{this.$store.state.departureTime}}出発</v-card-subtitle>
                            <p class="text-h5 text-center">
                                  {{this.$store.state.departureSpot}}
                            </p>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>

            <!-- 作成したルートをv-forで表示 -->



            <v-timeline>
                <v-timeline-item

                    v-for="(route, index) in $store.state.routes"
                    v-bind:key="route.name"
                >
                    <v-card
                        class="card"
                        elevation="3"
                        outlined
                    >
                    <v-row>
                        <v-col cols=2 class="ml-2 mt-2 pb-0">
                            No.{{index+1}}
                        </v-col>
                        <v-col class="ml-2 mt-2 pb-0">
                            {{route.arrive_at}} ~ {{route.departure_at}}
                        </v-col>

                    </v-row>
                    <v-divider class="mx-2"></v-divider>
                    <v-row>

                        <v-col class="mx-2">
                            <!-- <v-row> -->
                                <v-card-title>{{ route.name }}</v-card-title>
                                <v-card-subtitle>タグ:食事処</v-card-subtitle>
                                <v-card-text>
                                    <div>住所:{{ route.address }}</div>
                                    <div>TEL:{{ route.tel }}</div>
                                </v-card-text>

                            <!-- </v-row> -->
                        </v-col>

                    </v-row>
                    </v-card>
                
                </v-timeline-item>
            </v-timeline>





            <!-- 帰宅地 -->
            <v-col cols=12>
                <v-card
                    class="card"
                    elevation="3"
                    outlined
                > 
                    <v-row>   
                        <!-- データの枠組み -->
                        <v-col>
                            <v-card-subtitle class="text-center">{{this.$store.state.timeToGoHome}}到着</v-card-subtitle>
                            <p class="text-h5 text-center">
                                {{this.$store.state.returnSpot}}
                            </p>
                        </v-col>
                    </v-row>
                </v-card>

            </v-col>

            <!-- 右半分 -->
            <!--     <v-col>
            </v-col> -->


        </v-row>
    </v-container>
    </div>

</template>


<script>
   
export default {
    //props: ["spots"],

    data() {
        return {
            vehicle: "",
            click: "",

        };
    },
    methods: {
        formatDate(date) {
            if (!date) return null;
            const [year, month, day] = date.split("-");
            this.text = `${year}${month}${day}`;
            this.menu = false;
            return;
        },
    },
    mounted(){
        
    },
};
//axios.get(this.url,{ withCredentials: true })
        


</script>

