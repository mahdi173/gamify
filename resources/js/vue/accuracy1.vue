<template>
<div>
    <div class="container ">
        <div class="border">
            <div class="question bg-white p-3 border-bottom">
                <div class="d-flex flex-row justify-content-between align-items-center mcq">
                    <h5 class="mt-1 ml-2">Choisir la ligne qu'est la plus large </h5>
                     <h4> <i class="bi bi-stopwatch"><sub> {{count}}</sub></i> </h4>
                </div>
            </div>
        </div>
        <div class="border">
            <div class="raw d-flex">
                <div class="col  mt-5">
                  <button class="btn btn-outline-light" >  <label class="vertical1" id="l1" @click="choix('l1')" ></label></button>
                </div>
                <div class="col mt-4">
                    <button class="btn btn-outline-light">  <label class="vertical2" id="l2" @click="choix('l2')"></label> </button>
                </div>
                <div class="col mt-3">
                    <button class="btn btn-outline-light">  <label class="vertical3" id="l3" @click="choix('l3')"></label> </button>
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
            if(id=='l1') {
                axios.post('api/questions/AnsAc1Nv3', {isCorrect: true  })
                    .then(response => {
                        console.log(response.data);
                        this.$router.push('/Details1');

                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        timer(){
            this.time= setInterval(this.countDown,800);
        },
        countDown(){
            this.count=this.count-1;
            if(this.count==0){
                clearTimeout(this.time);
                this.$router.push('/Details1');
            }
        }
    },
    created(){
        this.timer();
    }
}
</script>
