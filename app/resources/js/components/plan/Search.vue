<template>
    <div>
        <v-card>
            <v-row>
                <v-col cols=4>
                    旅予定日
                    <v-menu
                        ref="menu"
                        v-model="menu"
                        :close-on-content-click="false"
                        :return-value.sync="date"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="date"
                                label="yyyy-mm-dd"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="date"
                            no-title
                            scrollable
                        >
                            <v-spacer></v-spacer>
                            <v-btn
                                text
                                color="primary"
                                @click="menu = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                text
                                color="primary"
                                @click="$refs.menu.save(date)"
                            >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>
                </v-col>
                <v-col>
                    移動手段        
                    <v-row>
                        <v-col justify="space-around">
                            <v-icon
                                large
                                color="green darken-2"
                            >
                                mdi-walk
                            </v-icon>

                            <v-icon
                                large
                                color="blue darken-2"
                            >
                                mdi-car-hatchback
                            </v-icon>

                            <v-icon
                                large
                                color="orange darken-2"
                            >
                                mdi-train
                            </v-icon>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col>
                    <v-btn
                        color="primary"
                        elevation="2"
                        v-on:click="createPlan"
                    >検索
                    </v-btn>
                            
                    
                </v-col>
            </v-row>

            <v-row>

                <v-col cols=6>
                    出発
                    <v-row>
                        <v-col>
                            <v-text-field
                                v-model="depSpot"
                                label="出発予定地を入力"
                                type="text"
                                prepend-icon="mdi-map-marker-outline"

                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col
                            sm="5"
                        >
                            <v-dialog
                                ref="dialog1"
                                v-model="modal1"
                                :return-value.sync="depTime"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="depTime"
                                        label="出発予定時刻を入力"
                                        prepend-icon="mdi-clock-time-four-outline"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-time-picker
                                    v-if="modal1"
                                    v-model="depTime"
                                    full-width
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="modal1 = false"
                                    >Cancel
                                    </v-btn>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="$refs.dialog1.save(depTime)"
                                    >OK</v-btn>
                                </v-time-picker>
                            </v-dialog>
                        </v-col>
                    </v-row>
                </v-col>

                <v-col cols=6>
                    帰宅
                    <v-row>
                        <v-col>
                            <v-text-field
                                v-model="retSpot"
                                label="帰宅予定地を入力"
                                type="text"
                                prepend-icon="mdi-map-marker-outline"

                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col
                            sm="5"
                        >
                            <v-dialog
                                ref="dialog2"
                                v-model="modal2"
                                :return-value.sync="retTime"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="retTime"
                                        label="帰宅予定時刻を入力"
                                        prepend-icon="mdi-clock-time-four-outline"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-time-picker
                                    v-if="modal2"
                                    v-model="retTime"
                                    full-width
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="modal2 = false"
                                    >Cancel
                                    </v-btn>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="$refs.dialog2.save(retTime)"
                                    >OK</v-btn>
                                </v-time-picker>
                            </v-dialog>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row> 
        </v-card>
        <v-card>
            <!-- <div>
                {{ reqTime }}
            </div> -->
        </v-card>
    </div>

</template>
    


<script>   

export default {
    data() {
        return {
            menu: "",
            text: "",
            picker: "",
            info: null,
            date: "",
            modal1: false, modal2: false,


            // 登録した観光地一覧を格納する配列
            spots:[],

            // googleDirectionsApiURLのベース
            Domain: 'https://maps.googleapis.com',
            BaseURL: '/maps/api/directions/json?',
            BaseOrigin: 'origin=',
            BaseDestination: '&destination=',
            GoogleMapApiKey: '&key=AIzaSyDdIBbhkb1--3sVblCBJ43BXkgU5wEpRvc',
            
            // 作成した経路リスト
            destinations: [],

            // 経路の所要時間
            reqTime: 0,
            // 交通手段
            vehicle: "",
            // 出発地/帰宅地
            depSpot: "", retSpot: "",
            // 出発時間/帰宅時間            
            depTime: "", retTime: "",
        };
    },
    methods: {
        


        createPlan(){

            // 手順
            // 前提：出発地、帰宅地、それぞれの時間、各スポットの所要時間がわかっている

            // １．全部の時間＝帰宅時間ー出発時間
            console.log('helo');
            const totalTime = this.retTime - this.depTime; //全旅程の制限時間
            var transportTime = []; // 各スポットの出発地・帰宅地からの移動時間
            console.log(totalTime);
            console.log(transportTime);
            
            
            // 登録済みスポット一覧取得
            // axios.get("/api/plan/read")
            //     .then((res) => {
            //         this.spots = res.data;
            //             console.log(spots);
            // });
            

            //     ２．一番遠いスポットから出発地・帰宅地までの時間を引いたものを変数に保持、それぞれ1.5倍しておき、全部の時間から引いたものが残り時間。

            // for (let index = 0; index < (this.spots).length ; index++) {
            //     const spotAddress = (this.spots).address
            //     transportTime[index][0] = this.destinationRead(this.depSpot, spotAddress);
            //     transportTime[index][1] = this.destinationRead(spotAddress, this.retSpot);

            //     console.log(spotAddress);
            // }


            //     ３．スポット間の移動時間を平均しておく
            //     ４．移動＋スポットの所要時間を１セットとして残りの時間から割り、おとづれるスポット数を計算
            //     ５．帰宅地から一番近い場所が最後に訪れる場所
            //     ６．残りの中で出発値から一番近い場所が最初に訪れる場所
            //     ７．残りの中でapiをたたき、それぞれの最短ルートを指定




        },




        // 経路の所要時間を求める関数
        // destinationRead(currentSpot, nextSpot){
        //     const Base = this.Domain + this.BaseURL;
        //     const Origin = this.BaseOrigin + currentSpot;
        //     const Destination = this.BaseDestination + nextSpot;
        //     const Purpose = Origin + Destination;
        //     const url = Base + Purpose + this.GoogleMapApiKey;

        //     var directions = [];
        //     var routes = [];
        //     var legs = [];
        //     var duration = "";
        //     var hours = [];
        //     var minutes = [];            
        //     var reqTime = "";

        //     axios.get(url)
        //         .then((response) => {
        //             directions = response.data;
        //             routes = directions.routes[0];
        //             legs = routes.legs[0];
        //             duration = legs.duration.text;
                    
        //             hours = duration.split('時間');
        //             minutes= hours[1].split('分');

        //             reqTime = parseInt(hours[0]) * 60 + parseInt(minutes[0]); 
        //     });
        //     return reqTime;
        // },
    },
};
        //axios.get(this.url,{ withCredentials: true })

            // 手順
            //     前提：出発地、帰宅地、それぞれの時間、各スポットの所要時間がわかっている
            //     １．全部の時間＝帰宅時間ー出発時間
            //     ２．一番遠いスポットから出発地・帰宅地までの時間を引いたものを変数に保持、それぞれ1.5倍しておき、全部の時間から引いたものが残り時間。
            //     ３．スポット間の移動時間を平均しておく
            //     ４．移動＋スポットの所要時間を１セットとして残りの時間から割り、おとづれるスポット数を計算
            //     ５．帰宅地から一番近い場所が最後に訪れる場所
            //     ６．残りの中で出発値から一番近い場所が最初に訪れる場所
            //     ７．残りの中でapiをたたき、それぞれの最短ルートを指定


        // https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood&key=AIzaSyDdIBbhkb1--3sVblCBJ43BXkgU5wEpRvc
        // http://localhost:8000/guest#/plan/maps/api/directions/json?origin=いいい&destination=ううう&key=AIzaSyDdIBbhkb1--3sVblCBJ43BXkgU5wEpRvc

</script>

        // 経路検索
        // durationSearch() {
        //     var YOUR_API_KEY= 'AIzaSyDdIBbhkb1--3sVblCBJ43BXkgU5wEpRvc';
        //     axios.get('https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood&key=AIzaSyDdIBbhkb1--3sVblCBJ43BXkgU5wEpRvc')
        //     .then((res) => {
    //            console.log(YOUR_API_KEY);
                // this.durat = res.data;
    //        });
            //console.log(YOUR_API_KEY);
    
        
        // routeSearch() {
        //     const alltime = retTime - depTime
    
        // }
        
