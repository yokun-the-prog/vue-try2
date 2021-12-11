<template>
    <div>
        <v-card>
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
                <v-col>
                    <v-btn
                        color="primary"
                        elevation="2"
                        v-on:click="this.createRoute"
                    >検索
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
            <div>
                {{ averageDuration }}
            </div>
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
            // 出発地/帰宅地
            depSpot: '', retSpot: '',
            // 出発時間/帰宅時間            
            depTime: '', retTime: '',
        };
    },
    computed:{
        totalTime: function() {
            const start = this.depTime.split(':');
            
            const end = this.retTime.split(':');
            
            const diff = (parseInt(end[0]) * 60 + parseInt(end[1])) - (parseInt(start[0]) * 60 + parseInt(start[1]));
            return diff;
        },

    },
    methods: {

        // 検索ボタンが押されたら、設定条件に応じて最適なルートを作成する関数
        createRoute: async function(){

            // 出発・帰宅地からの移動時間を入れる変数
            var reqTimeFromDeparture = '';
            var reqTimeToReturn = '';

            // 計算用配列
            var url= [];
            var response= [];
            var data= [];
            var durationText= [];
            
            // URL形成開始
            // url[0] = await this.creatURL("豊橋駅", "羽豆岬");// 行き
            url[0] = await this.creatURL(this.depSpot, "羽豆岬");// 行き
            console.log(url[0]);
            // url[1] = await this.creatURL("羽豆岬", "内海駅");// 帰り
            url[1] = await this.creatURL("羽豆岬", this.retSpot);// 帰り
            console.log(url[1]);
            
            // directionAPIからルート情報取得
            response = await axios.get(url[0]);// 行き
            data[0] = response.data;

            response = await axios.get(url[1]);// 帰り
            data[1] = response.data;

            // 所要時間のみ抜き取り実施
            durationText[0] = await this.pickDuration(data[0]); // 行き
            durationText[1] = await this.pickDuration(data[1]); // 帰り

            reqTimeFromDeparture = await this.transformDuration(durationText[0]);
            reqTimeToReturn = await this.transformDuration(durationText[1]);

            var remainTime = this.totalTime - (reqTimeFromDeparture + reqTimeToReturn);

            this.averageTerm = await this.calAverageTerm();
            this.averageDuration = await this.calDurationAmongSpots();
            // console.log('averageTermは'+this.averageTerm);
            // console.log('averageDurationは'+this.averageDuration);

            // ここから下関数化
            // 訪問できるスポット数算出
            var spotNumbers = Math.floor((remainTime + this.averageDuration) / (this.averageTerm + this.averageDuration));
            console.log('スポット数は'+spotNumbers);
            if(spotNumbers> this.$store.state.spots.length){
                spotNumbers = this.$store.state.spots.length;
            };

            // ランダムにスポットを求める
            // ランダム計算用配列
            const allSpotNumbers = [...Array(this.$store.state.spots.length).keys()];
            console.log('allSpotNumbers');
            console.log(allSpotNumbers);

            const selected = this.randomSelect(allSpotNumbers.slice(), spotNumbers);
            selected.sort();
            console.log('selected');
            console.log(selected);

            // 帰る場所から一番近い場所がラスト
            const finalSpotIndex = await this.determineFinalSpot(selected);
            console.log('finalSpotIndex');
            console.log(finalSpotIndex);

            const routeArray = this.makeCombination(selected, 2);
            console.log('routeArray');
            console.log(routeArray);

            // 各移動時間を考慮して、近い順に並べる。

            const destinations = await this.chooseRoute(routeArray, finalSpotIndex, spotNumbers);

            // console.log('routeArrayは'+routeArray);
            // console.log('durationCombinationは'+this.durationCombination);





            // console.log($store.state.spots);
            //console.log(cal);
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
                        console.log('一致');
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
                        console.log('nominateSpot');
                        console.log(nominateSpot);
                        console.log('index');
                        console.log(index);
                        deletedArray.push(index);
                        console.log('deletedArray');
                        console.log(deletedArray);
                    }
                });
                console.log('nominateSpot');
                console.log(nominateSpot);
                console.log('routeArray');
                console.log(routeArray);
                
                console.log('deletedArray');
                console.log(deletedArray);
                

                for(var i=0; i<deletedArray.length; i++){
                    routeArray.splice(deletedArray[i]-i, 1);
                }
                console.log('削除後routeArray');
                console.log(routeArray);

                nominateSpot.forEach(nominateElement =>{
                    if (nominateElement[3] < comparedTime){
                        nextSpotIndex = nominateElement[0];
                        comparedTime = nominateElement[3];
                    }
                });
                // destinations.push(spots[nextSpotIndex]);
                console.log('nextSpotIndex');
                console.log(nextSpotIndex);

                resolve(nextSpotIndex);
            });

        },
        
        // 実際にルートを作る関数
        chooseRoute: async function(routeArray, finalSpotIndex, spotNumbers){
            let spots = this.$store.state.spots;
            var destinations = [];
            // var destinations = new Array(selected.length);

            routeArray = this.addInfoToRouteArray(routeArray);


            console.log('routeArray');
            console.log(routeArray);
            console.log('durationCombinationは');
            console.log(this.durationCombination);

            // destinations配列に訪問時間が遅い順に場所を追加していく
            destinations.push(spots[finalSpotIndex]);
            console.log('destinations');
            console.log(destinations);

            // [...Array(selected.length)].map(() => {
            //     console.log(1);


            // 近い順に訪問場所を決めてdestinations配列に追加していく
            // 訪問場所は決まっているので、
            var nextSpotIndex = finalSpotIndex;
            var currentSpot = [];
            // var nominateSpot = [];
            // var index = '';
            var remainSpot = [];
            var spotNumbersArray = [...Array(spotNumbers-1).keys()]
;

            // ※forループいれる！！
            // ループ終わった時にはルート完成している
            for await (let index of spotNumbersArray) {
                console.log((index+1)+'回目開始！');

                nextSpotIndex = await this.determineNearestSpot(routeArray, nextSpotIndex);
                destinations.push(spots[nextSpotIndex]);
                console.log('destinations');
                console.log(destinations);

                console.log('routeArray');
                console.log(routeArray);
                
            };


                // console.log('2回目開始！');

                // nextSpotIndex = await this.determineNearestSpot(routeArray, nextSpotIndex);
                // destinations.push(spots[nextSpotIndex]);
                // console.log('destinations');
                // console.log(destinations);

                // console.log('routeArray');
                // console.log(routeArray);

                // console.log('２回目開始！');

                // nextSpotIndex = await this.determineNearestSpot(routeArray, selected, finalSpotIndex);
                // destinations.push(spots[nextSpotIndex]);


                // routeArray.forEach(function(routeElement, index, all){
                //     if (routeElement.includes(nextSpotIndex)){
                //         var result = routeElement.filter(function( item ) { 
                //             return item !== nextSpotIndex;
                //         });
                //         nominateSpot.push(result);
                //         console.log('nominateSpot');
                //         console.log(nominateSpot);
                //         console.log('index');
                //         console.log(index);
                //         deletedArray.push(index);
                //         console.log('deletedArray');
                //         console.log(deletedArray);
                        
                //     }
                // });
                // console.log('nominateSpot');
                // console.log(nominateSpot);
                // console.log('routeArray');
                // console.log(routeArray);
                
                // console.log('deletedArray');
                // console.log(deletedArray);
                

                // for(var i=0; i<deletedArray.length; i++){
                //     routeArray.splice(deletedArray[i]-i, 1);
                // }
                // console.log('削除後routeArray');
                // console.log(routeArray);

                // nominateSpot.forEach(nominateElement =>{
                //      if (nominateElement[3] < comparedTime){
                //          nextSpotIndex = nominateElement[0];
                //          comparedTime = nominateElement[3];
                //     }
                // });
                // destinations.push(spots[nextSpotIndex]);
                // console.log('nextSpotIndex');
                // console.log(nextSpotIndex);
                // console.log('destinations');
                // console.log(destinations);

                //  console.log('２回目開始！');
                // nominateSpot =[];
                // deletedArray =[];

                // console.log('nominateSpot');
                //          console.log(nominateSpot);

                // routeArray.forEach(function(routeElement, index, all){
                //     if (routeElement.includes(nextSpotIndex)){
                //         var result = routeElement.filter(function( item ) { 
                //             return item !== nextSpotIndex;
                //         });
                //          nominateSpot.push(result);
                //          console.log('index');
                //          console.log(index);
                //          deletedArray.push(index);
                //          console.log('deletedArray');
                //          console.log(deletedArray);
                        
                //      }
                // });
                //  console.log('nominateSpot');
                // console.log(nominateSpot);
                // console.log('routeArray');
                // console.log(routeArray);
                
                // routeArray.indexOf(nextSpotIndex);
                // console.log('deletedArray');
                // console.log(deletedArray);
                

                // for(var i=0; i<deletedArray.length; i++){
                //     routeArray.splice(deletedArray[i]-i, 1);
                // }
                // console.log('削除後routeArray');
                // console.log(routeArray);

                // nominateSpot.forEach(nominateElement =>{
                //     if (nominateElement[3] < comparedTime){
                //          nextSpotIndex = nominateElement[0];
                //          comparedTime = nominateElement[3];
                //      }
                //  });
                //  destinations.push(spots[nextSpotIndex]);
                //  console.log('nextSpotIndex');
                //  console.log(nextSpotIndex);
                //  console.log('destinations');
                //  console.log(destinations);

                
                // routeArray.forEach(routeElement =>{
                //     if (routeElement.includes(nextSpotIndex)){
                //         var result = routeElement.filter(function( item ) { 
                //             return item !== nextSpotIndex;
                //         });
                //         nominateSpot.push(result);
                        
                //     }
                // }),
                // console.log('nominateSpot');
                // console.log(nominateSpot);


                // nominateSpot.forEach(nominateElement =>{
                //     if (nominateElement[3] < comparedTime){
                //         nextSpotIndex = nominateElement[0];
                //         comparedTime = nominateElement[3];
                //     }
                // }),
                // destinations.push(spots[nextSpotIndex]);
                // console.log('nextSpotIndex');
                // console.log(nextSpotIndex);
                // console.log('destinations');
                // console.log(destinations);


                // destinations.forEach(destinationElement =>{
                    
                //     destinationElement.push(spots[nextSpotIndex]);
                //     currentSpot = spots[nextSpotIndex].name;

                //     const targetUser = selected.find((v) => v.name === currentSpot);
                //     console.log('targetは'+targetUser);

                // });


                // routeArray.forEach(routeElement =>{
                //     const last = destinations.slice(-1)[0];
                //     const calcArray = [];
                //     if(routeElement[2] == last[2])
                //     {
                //         console.log('一致');
                //         console.log(routeElement[2]);
                //         calcArray.push(routeElement);

                //     }
                // });                


                // routeArray.forEach(item =>{
                //     item[3]
                // })
                // console.log(destinations);



                // const result = words.forEach(element =>{
                // console.log('hey');
                // console.log('hello'+element[0]);
                // if(element[0]=='one' && element[1]=='oneone'){
                // console.log('OK'+element[2]);
                // }
                // });
                // console.log(result);         
                return(destinations);
            
            
        },

        getIsDuplicate(arr1, arr2){
            return [...arr1, ...arr2].filter(item => arr1.includes(item) && arr2.includes(item)).length > 0;
        },

        
        determineFinalSpot: async function(selected){
            let finalSpotIndex = 0;
            let durationFromFinalSpot = 100000;
            for await (let index of selected) {
                // URL取得
                var url = await this.creatURL(this.$store.state.spots[index].name, this.retSpot);//※豊橋駅をユーザー入力値にする
                //console.log('urlは'+url);

                // directionAPIからルート情報取得
                var response = await axios.get(url);
                var data = response.data;

                // 所要時間のみ抜き取り実施
                var durationText = await this.pickDuration(data);
                var reqTime = await this.transformDuration(durationText);
                //console.log('ReqTimeは'+reqTime);
                if(parseInt(durationFromFinalSpot) > parseInt(reqTime)){
                    durationFromFinalSpot = parseInt(reqTime);
                    //console.log('reqTimeは'+reqTime);
                    finalSpotIndex = index;
                    //console.log('indexは'+index);
                }
                console.log('最後はここ！'+finalSpotIndex);
            };
            return finalSpotIndex;            
        },


        

        // ①一番遠いスポットと出発帰宅の間で経路探索
        // 全体の処理を関数化する

        
        // ②残り時間を計算して何箇所回るか決める -> 観光スポット間の移動時間計算しないといけない　-> OK
        // 全体の処理を関数化する



        // 全観光スポット間の平均所要時間を求める関数
        calAverageTerm: function () {
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
        calDurationAmongSpots: async function (){
            
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
            console.log(sum);

            const averageDuration = ( sum / allRoutes.length );
            console.log('averageDurationは' + averageDuration);

            this.durationCombination = allRoutes;
            // console.log('コンビネーションは');
            // console.log(this.durationCombination);

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
            console.log(data);
            return new Promise((resolve)=>{
                const routes = data.routes[0];
                const legs = routes.legs[0];
                const duration = legs.duration.text;
                // console.log(duration);    
                resolve(duration);            
            });
        },


        // JSONから抜き取った所要時間（テキスト）を分表記へ変換する関数
        transformDuration: function(toBeTransformed){
            
            return new Promise((resolve)=>{
                var splitResult= [];
                var afterSplited= [];
                // console.log('transform');
                // JSONテキストを配列に入れる（日、時間、分）
                splitResult = this.splitTime(toBeTransformed, '日');    
                afterSplited[0] =  splitResult[0];
                // console.log('transform'+ splitResult);
                
                splitResult = this.splitTime(splitResult[1], '時間');
                afterSplited[1] =  splitResult[0];
                
                splitResult = this.splitTime(splitResult[1], '分');
                afterSplited[2] =  splitResult[0];

                const reqTime = parseInt(afterSplited[0]) * 3600 + parseInt(afterSplited[1]) * 60 + parseInt(afterSplited[2]);
                // console.log('reqTimeは' +reqTime);
                resolve(reqTime);
            });
        },


        splitTime: function(toBeSplited, delimiter){ 
            var afterSplited =[];
            const tempText = toBeSplited.split(delimiter);
            //console.log('tempTextは' + tempText[0]);
            
            if(tempText[0]!=toBeSplited){ // 変わっている==splitできた
                //console.log('if文の中です');

                afterSplited[0] = tempText[0];
                afterSplited[1] = tempText[1];
            }
            else{ // 変わっていない==splitできなかった
                //console.log('else文の中です');

                afterSplited[0] = '0';
                afterSplited[1] = tempText[0];
                //console.log(afterSplited);
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
            //console.log(reqMinutes);
            
        },



        createPlan: function(){

            // 手順
            // 前提：出発地、帰宅地、それぞれの時間、各スポットの所要時間がわかっている
            //var AllSpot = $store.state.spots;
            // １．全部の時間＝帰宅時間ー出発時間
            //console.log('helo');

            var st= "";
            var transportTime = []; // 各スポットの出発地・帰宅地からの移動時間
            var fromDepSpot = [];
            var toRetSpot = [];
            //console.log(this.totalTime);
            //console.log(this.$store.state.spots);
        
            //console.log(transportTime);
            
            //     ２．一番遠いスポットから出発地・帰宅地までの時間を引いたものを変数に保持、それぞれ1.5倍しておき、全部の時間から引いたものが残り時間。
            
            //     一番遠いスポットから出発地・帰宅地までの時間を引いたものを変数に保持、


            // const promise = new Promise((resolve, reject) => { // #1
            //     this.destinationRead("豊橋駅","内海駅")
            //     resolve('Hello ')
            // });

            

            this.$store.state.spots.forEach(function(index){
                console.log(index.id);
                
                //this.destinationRead("豊橋駅","内海駅");
                
                //st = await destinationRead('豊橋駅', '内海駅');
                
                //fromDepSpot[index.id] = await this.destinationRead("豊橋駅", "内海駅");
                //     .then(res =>{
                //         console.log("1");
                //         //return res
                //     }).catch(error =>{
                //         console.log("");
                //         //return res
                // });
                
               //    this.desfromDepSpot[index.id-1] = this.destinationRead("豊橋駅", "豊橋駅")
            });



            // promise.then((msg) => { // #2
            //     return new Promise((resolve, reject) => {
            //         setTimeout(() => {
            //             this.$store.state.spots.forEach(function(index){ this.desfromDepSpot[index.id-1] = this.destinationRead("豊橋駅", "豊橋駅")}
            //             console.log("hello")// = this.destinationRead(this.depSpot, index.address);
            //             resolve(msg + "I'm ")
            //         }, 500)
            //     })
            // }).then((msg) => { // #3
            //     console.log('#3')
            //     return msg + 'Jeccy.'
            // }).then((msg) => { // #4
            //     console.log('#4')
            //     console.log(msg)
            // }).catch(() => { // エラーハンドリング
            //     console.error('Error with Promise!')
            // })
            
            //this.$store.state.spots.forEach(function(index){
                //console.log(index);
              //  console.log('heloppppp');
                //console.log(index.id);　indexに配列が入っていく
                
                //fromDepSpot[index.id-1] = this.destinationRead("豊橋駅", "豊橋駅");
//                this.destinationRead(this.depSpot, index.address);

                //fromDepSpot[index.id-1] = index.name;
                //toRetSpot[index.id-1] = index.id;
            //});
            //console.log(fromDepSpot);
             //       this.blockTime(2000);
            //console.log(toRetSpot);

            //console.log(transportTime);


            // for (let index = 0; index < AllSpot.length; index++) {
            //     //const element = array[index];
            //     //transportTime[index][0] = $store.state.spot
            //     console.log('helo');

            // }





            // const HomeToSpot = this.destinationRead(depSpot, );
            // const SpotToHome = this.destinationRead(, retSpot);
            // const LifeTime = this.totalTime - (HomeToSpot + SpotToHome);
            

            
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


    },
    
    getters() {
        // 全観光スポット間の移動時間を求める関数をマウント
        this.calDurationAmongSpots();
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
        
