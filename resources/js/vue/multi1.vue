<template>
    <div>
        <div class="container mt-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10 col-lg-10">
                    <div class="border">
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                <h5 class="mt-1 ml-2">Aretter tous les countdown à {{nbr}}</h5>
                              <!--  <h4> <i class="bi bi-stopwatch"><sub> {{count}}</sub></i> </h4> -->
                            </div>
                        </div>
                        <div class="question bg-white p-2 border-bottom">
                            <div class="row ml-2">
                                <div class="col-sm mt-3">
                                    <div class="raw ml-4"> {{count1}} </div>
                                    <div class="raw">
                                   <button type="button" class="btn btn-light btn-lg  mr-1" id="b1"  @click="stop('b1')"> Stop
                                   </button>
                                    </div>
                                </div>
                                <div class="col-sm mt-3">
                                    <div class="raw ml-4"> {{count2}} </div>
                                    <div class="raw">
                                        <button type="button" class="btn btn-light btn-lg  mr-1 " id="b2"  @click="stop('b2')"> Stop
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm mt-3">
                                    <div class="raw ml-4">    {{count3}} </div>
                                    <div class="raw">
                                        <button type="button" class="btn btn-light btn-lg  mr-1 " id="b3"  @click="stop('b3')"> Stop
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-2 mb-3">
                                <div class="col-sm mt-5">
                                    <div class="raw ml-4"> {{count4}}  </div>
                                    <div class="raw">
                                        <button type="button" class="btn btn-light btn-lg  mr-1 " id="b4"  @click="stop('b4')"> Stop
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm mt-5">
                                    <div class="raw ml-4"> {{count5}} </div>
                                    <div class="raw ">
                                        <button type="button" class="btn btn-light btn-lg  mr-1 " id="b5"  @click="stop('b5')"> Stop
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm mt-5">
                                    <div class="raw ml-4"> {{count6}} </div>
                                    <div class="raw">
                                        <button type="button" class="btn btn-light btn-lg  mr-1 " id="b6"  @click="stop('b6')"> Stop
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="border mb-5">
                                <button v-if="this.nbrRep==6" class="btn  bg-primary mt-2 mr-1" style="float:right;" @click="postAns()"> Next </button>
                            </div>
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
            nbr:0 ,
            count1: 22,
            count2: 22,
            count3: 22,
            count4: 22,
            count5: 22,
            count6: 22,
            time1: 0,
            time2: 0,
            time3: 0,
            time4: 0,
            time5: 0,
            time6:0,
            nbrRep:0
        }
    },
    methods:{
        randomNumber (){
            // x = Math.random() * (max - min) + min;
            this.nbr = parseInt (Math.random() * (15 - 1) + 1);
        },
        start(){
            this.time1=setInterval(this.countDown1,1000);
           this.time2= setInterval(this.countDown2,900);
            this.time3= setInterval(this.countDown3,800);
            this.time4=setInterval(this.countDown4,700);
            this.time5= setInterval(this.countDown5,300);
            this.time6= setInterval(this.countDown6,500);
        },
        stop(id){
            let b = document.getElementById(id);
            if(id=='b1'){
                if(this.count1==this.nbr){
                    clearTimeout(this.time1);
                    b.classList.add('bg-success');
                    this.nbrRep+=1;
                }else{
                    this.stopAll();
                    b.classList.add('bg-danger');
                }
            }else if (id=='b2'){
                if(this.count2==this.nbr){
                    clearTimeout(this.time2);
                    b.classList.add('bg-success');
                    this.nbrRep+=1;
                }else{
                    this.stopAll();
                    b.classList.add('bg-danger');
                }
            }else if (id=='b3'){
                if(this.count3==this.nbr){
                    clearTimeout(this.time3);
                    b.classList.add('bg-success');
                    this.nbrRep+=1;
                }else{
                    this.stopAll();
                    b.classList.add('bg-danger');
                }
            }else if (id=='b4'){
                if(this.count4==this.nbr){
                    clearTimeout(this.time4);
                    b.classList.add('bg-success');
                    this.nbrRep+=1;
                }else{
                    this.stopAll();
                    b.classList.add('bg-danger');
                }
            }else if (id=='b5'){
                if(this.count5==this.nbr){
                    clearTimeout(this.time5);
                    b.classList.add('bg-success');
                    this.nbrRep+=1;
                }else{
                    this.stopAll();
                    b.classList.add('bg-danger');
                }
            }else if (id=='b6'){
                if(this.count6==this.nbr){
                    clearTimeout(this.time6);
                    b.classList.add('bg-success');
                    this.nbrRep+=1;
                }else{
                    this.stopAll();
                    b.classList.add('bg-danger');
                }
            }

            if( this.nbrRep==6){
              this.postAns();
            }
        },
        postAns (){
            axios.post('api/questions/AnsMulti1')
                .then( response=> {
                    console.log(response.data);
                })
                .catch( error=> { console.log("error");
                })
            this.$router.push('/Accuracy2');
        },
        countDown1(){
            let b1 = document.getElementById('b1');
            this.count1=this.count1-1;
            if(this.count1==this.nbr-1){
                this.stopAll();
                b1.classList.add('bg-danger');
            }
        },
        countDown2(){
            let b2= document.getElementById('b2');
            this.count2=this.count2-1;
             if(this.count2==this.nbr-1){
                 this.stopAll();
                 b2.classList.add('bg-danger');
             }
        },
        countDown3(){
            let b3= document.getElementById('b3');
            this.count3=this.count3-1;
            if(this.count3==this.nbr-1){
                this.stopAll();
                b3.classList.add('bg-danger');
            }
        },
        countDown4(){
            let b4= document.getElementById('b4');
            this.count4=this.count4-1;
            if(this.count4==this.nbr-1){
                this.stopAll();
                b4.classList.add('bg-danger');
            }
        },
        countDown5(){
            let b5= document.getElementById('b5');
            this.count5=this.count5-1;
            if(this.count5==this.nbr-1){
                this.stopAll();
                b5.classList.add('bg-danger');
            }
        },
        countDown6() {
            let b6= document.getElementById('b6');
            this.count6 = this.count6 - 1;
            if (this.count6 == this.nbr-1) {
                this.stopAll();
                b6.classList.add('bg-danger');
            }
        },
        stopAll(){
           let tabItem = [this.time1, this.time2, this.time3, this.time4, this.time5,this.time6];
           for(let i=0; i<tabItem.length; i++){
               clearTimeout(tabItem[i]);
           }
            this.$router.push('/Accuracy2'); // si il n'a pas reussit => go to next game

        }
    },
    created(){
        this.randomNumber();
        this.start();
    }
}
</script>

