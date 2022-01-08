<template>
    <div>
        <div class="container ">
            <div class="border" id="b-answers">
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h5 class="mt-1 ml-2">Trouver le nombre {{nbr}} </h5>
                        <h4> <i class="bi bi-stopwatch"><sub> {{count}}</sub></i> </h4>
                    </div>
                </div>
            </div>
            <div class="border">
                <div class="raw mt-4 ml-5 mb-3">
                    <div class="row d-flex">
                            <div class="col"  v-for="v in valTab.slice(0,8)">
                                <button class="btn mt-1 shadow-none" style="background-color:blanchedalmond;" :value="v" @click="ans(v)"> {{v}}</button>
                            </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col"  v-for="v in valTab.slice(9,17)">
                            <button class="btn mt-1 shadow-none"  style="background-color:blanchedalmond;":value="v" @click="ans(v)">{{v}}</button>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col"  v-for="v in valTab.slice(18,26)">
                            <button class="btn mt-1 shadow-none" style="background-color:blanchedalmond;" :value="v" @click="ans(v)"> {{v}}</button>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col"  v-for="v in valTab.slice(27,35)">
                            <button class="btn mt-1 shadow-none" style="background-color:blanchedalmond;" :value="v" @click="ans(v)"> {{v}}</button>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col"  v-for="v in valTab.slice(36,44)">
                            <button class="btn  mt-1 shadow-none" style="background-color:blanchedalmond;" :value="v" @click="ans(v)"> {{v}}</button>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col"  v-for="v in valTab.slice(45,53)">
                            <button class="btn mt-1 shadow-none" style="background-color:blanchedalmond;" :value="v" @click="ans(v)"> {{v}}</button>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col"  v-for="v in valTab.slice(54,62)">
                            <button class="btn mt-1 shadow-none" style="background-color:blanchedalmond;" :value="v" @click="ans(v)"> {{v}}</button>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col"  v-for="v in valTab.slice(63,71)">
                            <button class="btn mt-1 shadow-none" style="background-color:blanchedalmond;" :value="v" @click="ans(v)"> {{v}}</button>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col"  v-for="v in valTab.slice(72,80)">
                            <button class="btn mt-1 shadow-none" style="background-color:blanchedalmond;" :value="v" @click="ans(v)"> {{v}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data : function (){
        return {
            count: 30,
            time:0,
            valTab: [],
            nbr: parseInt (Math.random() * (9 - 4) + 4)

        }
    },
    methods:{
        ans(value){
            let border= document.getElementById('b-answers');
            if(value==this.nbr) {
                border.classList.add("border-success");
                this.$router.push('/Multi1');

                /*axios.post('api/questions/AnsDT1Nv3', {isCorrect: true  })
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    })*/
            }else{
                border.classList.add("border-danger");

            }
        },
        shuffleArray() {
            for (let z = 0; z< 79; z++) {
                this.valTab[z]=3;
            }
            this.valTab[79]= this.nbr;
            for (let i = this.valTab.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [this.valTab[i], this.valTab[j]] = [this.valTab[j], this.valTab[i]];
            }
            console.log(this.valTab);
            },
        timer(){
            this.time= setInterval(this.countDown,800);
        },
        countDown(){
            this.count=this.count-1;
            if(this.count==0){
                clearTimeout(this.time);
                this.$router.push('/Multi1');

            }
        }
    },
    created(){
        this.shuffleArray();
        this.timer();
    }
}
</script>
