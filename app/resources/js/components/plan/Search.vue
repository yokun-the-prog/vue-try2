<template>
    <div>
        
        <v-card mx-4 px-4>
            <v-row>
                <v-col cols=4>
                    旅予定日 <!-- {{$store.state.spots[0].name}} -->
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
                                v-model="$store.state.schedule"
                                label="yyyy-mm-dd"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="$store.state.schedule"
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
                                @click="$refs.menu.save(date); calcDurationAmongSpots();"
                            >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>
                </v-col>
                <v-col cols=4>
                </v-col>
                <!-- <v-col>
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
                </v-col> -->
                <v-col cols=2>
                    <v-btn
                        color="primary"
                        elevation="2"
                        v-on:click="this.createRoute"
                    >検索
                    </v-btn>
                    <!-- クリック後の動作修正v-on:click="createPlan; $store.state.planCreateFlag = true;" -->                    
                </v-col>
                <v-col>
                    <v-btn
                        color="primary"
                        elevation="2"
                        v-on:click="this.storeTour"
                    >旅を保存
                    </v-btn>
                    <!-- クリック後の動作修正v-on:click="createPlan; $store.state.planCreateFlag = true;" -->                    
                </v-col>

            </v-row>

            <v-row>

                <v-col cols=6>
                    出発
                    <v-row>
                        <v-col>
                            <v-text-field
                                v-model="this.$store.state.departureSpot"
                                label="出発予定地を入力"
                                type="text"
                                prepend-icon="mdi-map-marker-outline"
                                value="豊橋駅"
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
                                :return-value.sync="$store.state.departureTime"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="$store.state.departureTime"
                                        label="出発予定時刻を入力"
                                        prepend-icon="mdi-clock-time-four-outline"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-time-picker
                                    v-if="modal1"
                                    v-model="$store.state.departureTime"
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
                                        @click="$refs.dialog1.save($store.state.departureTime)"
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
                                v-model="$store.state.returnSpot"
                                label="帰宅予定地を入力"
                                type="text"
                                prepend-icon="mdi-map-marker-outline"
                                value="豊橋駅"

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
                                :return-value.sync="$store.state.returnTime"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="$store.state.returnTime"
                                        label="帰宅予定時刻を入力"
                                        prepend-icon="mdi-clock-time-four-outline"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-time-picker
                                    v-if="modal2"
                                    v-model="$store.state.returnTime"
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
                                        @click="$refs.dialog2.save($store.state.returnTime)"
                                    >OK</v-btn>
                                </v-time-picker>
                            </v-dialog>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row> 
        </v-card>
    </div>

</template>
    


<script>   

export default {
    data() {
        return {
            menu: '',
            text: '',
            picker: '',
            info: null,
            date: '',
            modal1: false, modal2: false,
            show: true,
            // 観光スポットの平均観光時間
            averageTerm: '',
            // 観光スポット間の平均移動時間
            averageDuration: '',

            // 作成した経路リスト
            destinations: [],
            durationCombination: [],    

            // 経路の所要時間
            reqMinutes: '',
            reqTime: '',
            // 交通手段
            vehicle: '',

        };
    },
    computed:{
        totalTime: function() {
            const start = this.$store.state.departureTime.split(':');
            const end = this.$store.state.returnTime.split(':');
            const diff = (parseInt(end[0]) * 60 + parseInt(end[1])) - (parseInt(start[0]) * 60 + parseInt(start[1]));
            return diff;
        },

    },
    methods: {

        storeTour: function(){
            const vm = this;
            var tour_id=0;
            var tourInfo = {
                "user_id" : this.$store.state.userInformation.id,
                "photorally_division_id" : 1,
                "transport_division_id" : 1,
                "schedule" : this.$store.state.schedule,
                "departure_spot" : this.$store.state.departureSpot,
                "return_spot" : this.$store.state.returnSpot,
                "departure_at" : this.$store.state.departureTime,
                "return_at" : this.$store.state.timeToGoHome,
            };
            
            axios.post("/api/tour/store", tourInfo)
                .then(response => {
                    this.tour_id = response.data;
                })
                .then(response =>{
                    this.storeDestinations(this.tour_id);
                })
                .then(response =>{
                    this.$store.state.successShow = true;
                    // setTimeoutで3000ms後にshowをfalseにする
                    setTimeout(() => {
                        this.$store.state.successShow = false}
                        ,3000
                    );
                })
                .then(response =>{
                    this.readTours();
                })
                .then(response =>{
                    this.$router.push('/history');
            });          
        },

        storeDestinations: async function(tour_id){
            
            var routes = this.$store.state.routes;
            routes.forEach(routeElement =>{
                var destinationsInfo={
                    "tour_id" : this.tour_id,
                    "spot_id" : routeElement.id,
                    "erratum_division_id" : 1,
                    "arrive_at" : routeElement.arrive_at,
                    "departure_at" : routeElement.departure_at,
                    "photorally_location" : '111-111-111',
                };         
                axios.post("/api/destination/store", destinationsInfo)
                    .then(response=>{
                        console.log(response.data);
                });
            });



            
            // axios.post("/api/destinations/store", destinationsInfo)


        },
        // 検索ボタンが押されたら、設定条件に応じて最適なルートを作成する関数
        createRoute: async function(){
            

            // Routesの初期化
            this.saveRoutes([]);
           
            // 検索結果の初期化
            this.$store.state.planCreateFlag = false;


            // 出発・帰宅地からの移動時間を入れる変数
            var reqTimeFromDeparture = '';
            var reqTimeToReturn = '';

            // 所要時間を計算
            reqTimeFromDeparture = await this.calcRequireTimeFromSpot(this.$store.state.departureSpot, '羽豆岬');
            reqTimeToReturn = await this.calcRequireTimeFromSpot("羽豆岬", this.$store.state.returnSpot);

            // 残りの時間を算出
            var remainTime = this.totalTime - 1.2*(reqTimeFromDeparture + reqTimeToReturn);


            // 平均観光時間（と平均移動時間）を算出
            this.averageTerm = await this.calcAverageTerm();
            


            // ここから下関数化
            // 訪問できるスポット数算出
            var spotNumbers = Math.floor((remainTime + this.averageDuration) / (this.averageTerm + this.averageDuration));
            if(spotNumbers > this.$store.state.spots.length){
                spotNumbers = this.$store.state.spots.length;
            };

            // ランダムにスポットを決める
            // ランダム計算用配列
            var allSpotNumbers = [...Array(this.$store.state.spots.length).keys()];


            var selected = this.randomSelect(allSpotNumbers.slice(), spotNumbers);
            selected.sort();

            // 帰る場所から一番近い場所を最終訪問スポットとする
            var finalSpotIndex = await this.determineFinalSpot(selected);

            // ルート探索用の配列を作成
            const routeArray = this.makeCombination(selected, 2);

            // 各移動時間を考慮して、近い順に並べる。
            const destinations = await this.chooseRoute(routeArray, finalSpotIndex, spotNumbers);
            const destinationsOpposite = destinations.slice().reverse();

            // 出発地から0番目の訪問スポットまでの時間を計算
            var reqTimeFromDepartureSpot = await this.calcRequireTimeFromSpot(this.$store.state.departureSpot, destinationsOpposite[0].name);

            // n番目の訪問スポットから帰宅地までの時間を計算
            var reqTimeToReturnSpot = await this.calcRequireTimeFromSpot(this.$store.state.returnSpot, destinationsOpposite[spotNumbers-1].name);

            var previousDepartureTime = 0;
            var durationToNextSpot = 0;
            // 時間を追加していく
            destinationsOpposite.forEach((destinationElement,index)=>{
                
                if (index==0){
                    destinationElement['arrive_at']= this.addTimeWithMinutes(this.$store.state.departureTime, reqTimeFromDepartureSpot)
                }
                else{
                    destinationElement['arrive_at']= this.addTimeWithMinutes(previousDepartureTime, durationToNextSpot);
                }

                destinationElement['departure_at']= this.addTimeWithMinutes(destinationElement['arrive_at'], parseInt(destinationElement['standard_term']));
                previousDepartureTime = destinationElement['departure_at'];
                durationToNextSpot = destinationElement['durationToNextSpot'];

            });
            this.$store.state.timeToGoHome = this.addTimeWithMinutes(destinationsOpposite[spotNumbers-1]['departure_at'] , reqTimeToReturnSpot);

            this.saveRoutes(destinationsOpposite);

            this.$store.state.planCreateFlag = true;

        },

        calcRequireTimeFromSpot: async function(departureSpot, returnSpot){

            // URL形成開始
            const url = await this.creatURL(departureSpot, returnSpot);
    
            // directionAPIからルート情報取得
            const response = await axios.get(url);
            const data = response.data;

            // 行き、帰りの移動時間を算出
            const durationText = await this.pickDuration(data);
            const durationAmongSpots = await this.transformDuration(durationText);
            
            return durationAmongSpots;
        },

        addInfoToRouteArray: function (routeArray) {
            let spots = this.$store.state.spots;
            // Indexになっている全ルート配列の名前を追加する
             routeArray.forEach((routeElement)=>{
                 spots.forEach((spotElement)=>{
                     if(routeElement[0] == parseInt(spotElement.id) - 1){
                         routeElement[2] = spotElement.name;
                     };
                     if(routeElement[1] == parseInt(spotElement.id) - 1){
                         routeElement[3] = spotElement.name;
                     };
                 })
            });

            // Indexになっている訪問観光スポットの名前を追加する
            routeArray.forEach(routeElement =>{
                this.durationCombination.forEach(durationElement =>{
                    if(routeElement[2]==durationElement[0] && routeElement[3]==durationElement[1]){
                        routeElement[4] = durationElement[2];
                    };
                })
            });
            return routeArray;
        },

        determineNearestSpot: function (routeArray, nextSpotIndex) {
            return new Promise((resolve) =>{
                var nominateSpot = [];
                var deletedArray = [];
                var comparedTime = 1000;

                routeArray.forEach(function(routeElement, index, all){
                    if (routeElement.includes(nextSpotIndex)){
                        var result = routeElement.filter(function( item ) { 
                            return item !== nextSpotIndex;
                        });
                        nominateSpot.push(result);
                        deletedArray.push(index);
                    }
                });

                for(var i=0; i<deletedArray.length; i++){
                    routeArray.splice(deletedArray[i]-i, 1);
                }

                nominateSpot.forEach(nominateElement =>{
                    if (nominateElement[3] < comparedTime){
                        nextSpotIndex = nominateElement[0];
                        comparedTime = nominateElement[3];
                    }
                });

                const nextSpot = [nextSpotIndex, comparedTime];
                resolve(nextSpot);

            });

        },
        
        // 実際にルートを作る関数
        chooseRoute: async function(routeArray, finalSpotIndex, spotNumbers){
            let spots = this.$store.state.spots;
            var destinations = [];

            routeArray = this.addInfoToRouteArray(routeArray);
            destinations.push(spots[finalSpotIndex]);

            // 近い順に訪問場所を決めてdestinations配列に追加していく
            var nextSpotIndex = finalSpotIndex;
            var spotNumbersArray = [...Array(spotNumbers-1).keys()];

            for await (let index of spotNumbersArray) {
                var nextSpot = await this.determineNearestSpot(routeArray, nextSpotIndex);
                nextSpotIndex = nextSpot[0];

                destinations.push(spots[nextSpotIndex]);
                destinations[index+1]["durationToNextSpot"]=nextSpot[1];


            };       
            destinations[0]["durationToNextSpot"]=0;

            return(destinations);
        },

        // 最終の訪問スポットのindexを求める
        determineFinalSpot: async function(selected){
            let finalSpotIndex = 0;
            let durationFromFinalSpot = 100000;

            for await (let index of selected) {
                // URL取得

                var reqTimeToReturn = await this.calcRequireTimeFromSpot(this.$store.state.spots[index].name, this.$store.state.returnSpot);

                if(parseInt(durationFromFinalSpot) > parseInt(reqTimeToReturn)){
                    durationFromFinalSpot = parseInt(reqTimeToReturn);
                    finalSpotIndex = index;
                }
            };
            return finalSpotIndex;            
        },


        

        // ①一番遠いスポットと出発帰宅の間で経路探索
        // 全体の処理を関数化する

        
        // ②残り時間を計算して何箇所回るか決める -> 観光スポット間の移動時間計算しないといけない　-> OK
        // 全体の処理を関数化する



        // 全観光スポット間の平均所要時間を求める関数
        calcAverageTerm: function () {
            return new Promise((resolve)=>{
                let sum = 0;
                // 全観光スポットの標準所要時間を配列に格納
                const standardTerm = this.$store.state.spots.map( item => item.standard_term );
                
                standardTerm.forEach(function (term) {
                    sum += parseInt(term);
                });
                const averageTerm = ( sum / standardTerm.length );
                resolve(averageTerm);
            });
        },

        // 全観光スポット間の平均移動時間を求める関数
        calcDurationAmongSpots: async function (){
            
            let sum = 0;
            // storeのspotsから各観光スポットの住所を抜き取り配列に入れ、ルートの組み合わせを求める
            const allSpotName = this.$store.state.spots.map( item => item.name );
            var allRoutes = this.makeCombination(allSpotName, 2);
            
            // 観光スポット間の移動時間を非同期処理で計算
            for await (let item of allRoutes) {
                // URL取得
                var url = await this.creatURL(item[0], item[1]);

                // directionAPIからルート情報取得
                var response = await axios.get(url);
                var data = response.data;

                // 所要時間のみ抜き取り実施
                var durationText = await this.pickDuration(data);
                var reqTime = await this.transformDuration(durationText);
                item[2] = reqTime;
                sum += parseInt(reqTime);

            };
            const averageDuration = ( sum / allRoutes.length );
            this.durationCombination = allRoutes;
            console.log(averageDuration);
            return averageDuration;

        },

        // コンビネーションを求める関数
        makeCombination: function (nums, k) {
            let ans = [];
            if (nums.length < k) {
                resolve([]);
            }
            if (k === 1) {
                for (let i = 0; i < nums.length; i++) {
                    ans[i] = [nums[i]];
                }
            } else {
                for (let i = 0; i < (nums.length - k + 1); i++) {
                    let row = this.makeCombination(nums.slice(i + 1), k - 1);
                    for (let j = 0; j < row.length; j++) {
                        ans.push([nums[i]].concat(row[j]));
                    }
                }
            }
            return ans;
        },
        
        // 配列arrayからランダムにnum個の要素を取り出す
        randomSelect: function(array, num)
        {
            let newArray = [];
        
            while(newArray.length < num && array.length > 0)
            {
                // 配列からランダムな要素を選ぶ
                const rand = Math.floor(Math.random() * array.length);
                // 選んだ要素を別の配列に登録する
                newArray.push(array[rand]);
                // もとの配列からは削除する
                array.splice(rand, 1);
            }
            return newArray;
        },

        // 一番遠いスポットと出発帰宅の間で移動にかかる時間求める　-> OK
        // 残り時間を計算して何箇所回るか決める -> 観光スポット間の移動時間計算しないといけない　-> OK
        // ランダムに観光地を選ぶ　->OK
        // 帰る場所から一番近い場所がラスト
        // 近い順に場所を選択していき、ルート配列を埋める
        // ルート表示し保存が押されたらlaravelapiでデータベースに保存

        

        // スポット間の所要時間をAPIを叩いて算出する関数
        // 引数：currentSpot, nextSpot

        // URLを形成
        // DirectionsAPIを叩いてJSONファイル取得（非同期！！）
        // 所要時間を配列に格納

        

        // 二点を指定してDirectionAPIのURLを作る関数
        creatURL: function (currentSpot, nextSpot) {
            // googleDirectionsApiURLのベース
            return new Promise((resolve)=>{
                const domain= 'https://maps.googleapis.com';
                const baseURL= '/maps/api/directions/json?';
                const baseOrigin= 'origin=';
                const baseDestination= '&destination=';
                const googleMapApiKey= '&key=AIzaSyDdIBbhkb1--3sVblCBJ43BXkgU5wEpRvc';
    
                // URL形成開始
                var base = domain + baseURL;
                var origin = baseOrigin + currentSpot;
                var destination = baseDestination + nextSpot;
                var purpose = origin + destination;
                var url = base + purpose + googleMapApiKey;
    
                resolve(url);            
            })
        },


        // JSONから所要時間（テキスト）を抜き取る関数
        pickDuration: function (data) {
            return new Promise((resolve)=>{
                const routes = data.routes[0];
                const legs = routes.legs[0];
                const duration = legs.duration.text;

                resolve(duration);            
            });
        },

        // 文字列型の時間と分の足し算
        addTimeWithMinutes: function(time, minutes){
            var timeTransformed = this.transformTextToMinutes(time);
            var addedResult = this.transformMinutesToText( parseInt( timeTransformed ) + parseInt( minutes ));
            return addedResult;  
        },

        // テキストの時間を分に変換する関数
        transformTextToMinutes: function(toBeTransformed){
            
            var splitResult= [];

            splitResult = this.splitTime(toBeTransformed, ':');
            var afterTransformed = parseInt(splitResult[0]) * 60 + parseInt(splitResult[1]);

            return(afterTransformed);

        },
        // 分をテキストの時間に変換する関数
        transformMinutesToText: function(toBeTransformed){
            
            var hours= '';
            var minutes='';

            hours = Math.floor( toBeTransformed / 60 ).toString().padStart(2, '0');
            minutes = (toBeTransformed % 60).toString().padStart(2, '0');
            var afterTransformed = hours + ':' + minutes;

            return(afterTransformed);

        },

        // JSONから抜き取った所要時間（テキスト）を分表記へ変換する関数
        transformDuration: function(toBeTransformed){
            
            return new Promise((resolve)=>{
                var splitResult= [];
                var afterSplited= [];

                // JSONテキストを配列に入れる（日、時間、分）
                splitResult = this.splitTime(toBeTransformed, '日');    
                afterSplited[0] =  splitResult[0];
                
                splitResult = this.splitTime(splitResult[1], '時間');
                afterSplited[1] =  splitResult[0];
                
                splitResult = this.splitTime(splitResult[1], '分');
                afterSplited[2] =  splitResult[0];

                const reqTime = parseInt(afterSplited[0]) * 3600 + parseInt(afterSplited[1]) * 60 + parseInt(afterSplited[2]);

                resolve(reqTime);
            });
        },


        splitTime: function(toBeSplited, delimiter){ 
            var afterSplited =[];
            const tempText = toBeSplited.split(delimiter);
            
            if(tempText[0]!=toBeSplited){ // 変わっている==splitできた

                afterSplited[0] = tempText[0];
                afterSplited[1] = tempText[1];
            }
            else{ // 変わっていない==splitできなかった

                afterSplited[0] = '0';
                afterSplited[1] = tempText[0];
            }

            return afterSplited;
            
        },

        // directionAPIを叩いて、所要時間を計算する関数
        // 引数：url   戻り値：所用時間（分）
        directionAPI: async function (url) {
            // 計算用配列
            var afterSplited= [];
            var splitResult = [];

            // directionAPIからルート情報取得
            const response = await axios.get(url);
            const data = response.data;

            // 所要時間のみ抜き取り実施
            const durationText = await this.pickDuration(data);

            // JSONテキストを配列に入れる（日、時間、分）
            splitResult = await this.splitTime(durationText, '日');    
            afterSplited[0] =  splitResult[0];

            splitResult = await this.splitTime(splitResult[1], '時間');
            afterSplited[1] =  splitResult[0];
            
            splitResult = await this.splitTime(splitResult[1], '分');
            afterSplited[2] =  splitResult[0];

            // 分単位の所要時間に変更
            const reqMinutes = parseInt(afterSplited[0]) * 3600 + parseInt(afterSplited[1]) * 60 + parseInt(afterSplited[2]);
            
        },

        readTags:function() {
            this.$store.dispatch('readTags','');
        },
        readSpots: function() {
            this.$store.dispatch('readSpots','');
        },
        saveRoutes: function(destinations){
            this.$store.commit('saveRoutes', destinations);
        },
        readTours: function() {
            this.$store.dispatch('readTours');
        },

    },
    mounted() {
        this.readTags();
        this.readSpots();
        
    },
};

            // 手順
            //     前提：出発地、帰宅地、それぞれの時間、各スポットの所要時間がわかっている
            //     １．全部の時間＝帰宅時間ー出発時間
            //     ２．一番遠いスポットから出発地・帰宅地までの時間を引いたものを変数に保持、それぞれ1.5倍しておき、全部の時間から引いたものが残り時間。
            //     ３．スポット間の移動時間を平均しておく
            //     ４．移動＋スポットの所要時間を１セットとして残りの時間から割り、おとづれるスポット数を計算
            //     ５．帰宅地から一番近い場所が最後に訪れる場所
            //     ６．残りの中で出発値から一番近い場所が最初に訪れる場所
            //     ７．残りの中でapiをたたき、それぞれの最短ルートを指定

</script>

