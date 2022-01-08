<template>
    <div>
        <div class="container ">
            <div class="border">
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h5 class="mt-1 ml-2">Choisir l'image qui tourne la plus vite </h5>
                        <h4> <i class="bi bi-stopwatch"><sub> {{count}}</sub></i> </h4>
                    </div>
                </div>
            </div>
            <div class="border">
                <div class="raw mt-3 d-flex">
                        <div class="col">
                            <button class="btn" >  <label  class="speed1" id="i1" @click="choix('i1')" ><i  style="font-size:6em;" class="bi bi-lightbulb"></i></label></button>
                        </div>
                        <div class="col">
                            <button class="btn ">  <label class="speed2" id="i2" @click="choix('i2')"><i  style="font-size:6em;" class="bi bi-lightbulb"></i></label> </button>
                        </div>
                </div>
                <div class="raw mt-3 d-flex">
                    <div class="col">
                        <button class="btn ">  <label class="speed3" id="i3" @click="choix('i3')"><i  style="font-size:6em;" class="bi bi-lightbulb"></i></label> </button>
                    </div>
                    <div class="col">
                        <button class="btn ">  <label class="speed4" id="i4" @click="choix('i4')"><i  style="font-size:6em;" class="bi bi-lightbulb"></i></label> </button>
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
            time:0
        }
    },
    methods:{
        choix(id){
            var l1 = document.getElementById('i1');
            var l2 = document.getElementById('i2');
            var l3 = document.getElementById('i3');
            var l4 = document.getElementById('i4');
            l1.classList.remove('speed1');
            l2.classList.remove('speed2');
            l3.classList.remove('speed3');
            l4.classList.remove('speed4');

             if(id=='i4') {
                 axios.post('api/questions/AnsAc2Nv3', {isCorrect: true  })
                     .then(response => {
                         console.log(response.data);
                     })
                     .catch(error => {
                         console.log(error);
                     })
                 this.$router.push('/Missions');

             }
        },
        timer(){
            this.time= setInterval(this.countDown,800);
        },
        countDown(){
            this.count=this.count-1;
            if(this.count==0){
                clearTimeout(this.time);
                this.$router.push('/Missions');

            }
        }
    },
    created(){
       // this.timer();
    }
}
</script>

