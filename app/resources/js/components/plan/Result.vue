<template>

    <div>        
    <v-container>

        <v-row>
            <!-- 左半分 -->
            <v-col cols=6>


                <!-- コンテンツ毎の枠組み forで回す-->
                <v-row
                    v-for="n in 3"
                    v-bind:key="n"
                >

                    <v-card> 
                        <v-row>   
                            <!-- idと交通手段 -->
                            <v-col cols=3>
                                01 <br>
                                <v-icon
                                    large
                                    color="blue darken-2"
                                >
                                    mdi-train
                                </v-icon>
                            </v-col>
                            
                            <!-- データの枠組み -->
                            <v-col cols=8>
                                09:00　発  <br>
                                自宅  <br>
                                住所： <br>
                                電話番号：  <br>
                                タグ： <br>
                            </v-col>
                        </v-row>
                    </v-card>

                </v-row>
        

            </v-col>

            <!-- 右半分 -->

            <v-col>


            </v-col>


        </v-row>
    </v-container>
    </div>

</template>


<script>
   
export default {
    //props: ["spots"],

    data() {
        return {
            Domain: "http://localhost:8000/guest#/plan/",
            BaseURL: "maps/api/directions/json",
            BaseOrigin: "?origin=Disneyland",
            BaseDestination: "&destination=Universal+Studios+Hollywood&key=",
            destination: "",
            GoogleMapApiKey: "AIzaSyDdIBbhkb1--3sVblCBJ43BXkgU5wEpRvc",
            
            destinations: [],
            // durat: [],


            vehicle: "",
            depSpot: "",
            retSpot: "",
            depTime: "",
            retTime: "",
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
        // read(){
        //     axios.get(this.url)
        //     .then((response) => {
        //         this.info = response.data;
        //         console.log(this.url);
        //         return;
        //     });
        // },
    },
    mounted(){
        
    },
};
//axios.get(this.url,{ withCredentials: true })
        


</script>

