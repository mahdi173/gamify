<template xmlns="http://www.w3.org/1999/html">
  <div>
    <div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="border">
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                    <h5 class="mt-1 ml-2">{{questions[0].contenuQst}}</h5>
                        <h4 v-if="!timeStop"> <i class="bi bi-stopwatch"><sub > {{count}}</sub></i> </h4>
                     </div>
                </div>
                <div class="question bg-white p-2 border-bottom">
                    <div class="row justify-content-center mt-5">
                    <!--<div class="col-sm mt-2 ml-3">
                        <div class="drops" id="drop" > </div>
                         <div class="plantHappy" id="plant"> </div>
                    </div>-->
                   <!-- <div class="col-sm">-->
                        <div v-for="(data, key) in questions">
                            <div class="col-sm ml-1 mr-2">
                                 <label class="button"> <input type="button"
                                   class="btn btn-light btn-lg  mr-1 mt-3" :id="data.abv" :value="data.contenu" @click="postAns(data.abv)">
                                 </label>
                            </div>
                        </div>
                        <!--</div>-->
                   </div>
                </div>
                <div class="mt-2">
                    <table class="table table-bordered" style="border:2px solid antiquewhite; height: 20%;">
                        <tbody>
                            <tr>
                                <td class=" " style="border:2px solid antiquewhite; width: 30%;" id="strike1">Streak
                                </td>
                                <td class=" " style="border:2px solid antiquewhite; width: 30%;" id="strike2"></td>
                                <td  class=" " style="border:2px solid antiquewhite; width: 30%;" id="strike3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div v-if="showModal">
                <div class="popup">
                    <div class="modal-wrapper col-sm-3">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bonus </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" @click="showModal = false">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body mb-5 align-self-center">
                                        <h5 style="text-align: center">{{bonus.name}}</h5>
                                        <img  class="ml-5" :src="'/uploads/'+bonus.img" style="border-radius: 50%;" width="100" height="100">
                                        <p style="text-align: center">{{bonus.descp}}</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


      <div v-if="expModal">
          <div class="popup">
              <div class="modal-wrapper col-sm-3">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" @click="returnMissions">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body mb-5 mt-2 align-self-center expBg ">
                              <h5 style="text-align: center" class="mt-5"> <strong>+ {{expTotal}} EXP</strong></h5>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</div>


</template>

<script>
export default{
    data : function (){
     return {
       questions: [],
         bonus:[],
       page :0,
         count: 30,
         nbrCorect:0,
         exp: false,
         timeStop: false,
         eraser: false,
         eraser2: false,
         expTotal: 1000,
         showModal:false,
         expModal:false,
         notCorrect:[]
     }
  },
  methods:{
    getQsts (page){
      axios.post('api/questions/getQsts', {page: page})
      .then( response=> {
           this.questions= response.data;
          this.count=30; //redefinition
          if(!this.timeStop) { // if user dont have this bonus
              //this.timer(); // appelle
          }
          this.eliminer();
          if(this.nbrCorect>=2){
              this.streak(true);
          }
          if(this.page==3){ // if we hit max of  questions
              //this.expModal= true;
              this.expModal=true;

          }
        })
      .catch( error=> { console.log(error);
       })
    },
    postAns(dataAbv){
         var rep = document.getElementById(dataAbv);
        axios.post('api/questions/postAns', {rep: dataAbv, page: this.page+1, double:this.exp} )
       .then(response => {
        if(response.data){
            this.nbrCorect += 1;
            rep.classList.add('bg-success');
             window.setTimeout(function () {
              rep.classList.remove('bg-success');
            }, 1000);
             // s'il a donné 2 ou plusieurs réponses correctes => il recevra un bonus (ability)

             if(this.exp || this.eraser2 || this.eraser || this.timeStop){
                 this.eraser2= false;
                 this.timeStop= false;
                 this.eraser= false;
                 this.exp= false;
             }
        }else{
            this.streak(false);
            this.nbrCorect=0;
            rep.classList.add('bg-danger');
            window.setTimeout(function () {
              rep.classList.remove('bg-danger');
            }, 1000);
        }
        this.getQsts(this.page+=1);
            if(this.page==3){
                //this.expModal= true;
                this.expModal=true;
                //this.$router.push('/Missions');
            }
       })
       .catch( error=> { console.log(error);
       })
    },
      timer(){
          setTimeout(this.countDown,1000);
      },
      countDown(){
          this.count=this.count-1;
          if(this.count==0 && this.page!=3){
              this.getQsts(this.page=this.page+1);
          }else{
              this.timer();
          }
      },
      streak(bool){
          let td1 = document.getElementById('strike1');
          let td2 = document.getElementById('strike2');
          let td3 = document.getElementById('strike3');
          let tabTd= [td1,td2,td3];
          if(bool) {
              if (td1.classList.contains('streak')) {
                  if (!td2.classList.contains('streak')) {
                      td2.classList.add('streak');
                  } else {
                      td3.classList.add('streak');
                  }
              } else {
                  td1.classList.add('streak');
                  //console.log(td1);
              }
              axios.get('api/questions/randomBonus')
                  .then( response=> {
                      this.bonus= response.data[0];
                      console.log(this.bonus.name);
                      this.showModal=true;

                      if(this.bonus.name=="ExpX2"){
                          this.exp=true

                      }else if(this.bonus.name=="50/50"){
                          // not sure yet
                          this.exp=true

                      }else if (this.bonus.name=="Time Freeze"){
                          this.exp=true

                          this.timeStop= true;
                      }else if (this.bonus.name=="Eraser"){
                          this.exp=true

                          let x = Math.floor(Math.random() * 3);
                          let btn = document.getElementById(this.notCorrect[x]);
                          btn.classList.replace('btn-light','btn-danger');
                      }
                  })
                  .catch( error=> { console.log(error);
                  })
          }else{
              for (let i = 0; i < tabTd.length; i++) {
                  tabTd[i].classList.remove('streak');
              }
          }
      },
      eliminer(){
        // put the wrong answers in array so we can decide which one to tell the user about when he get a bonus
        let i=0;
          this.questions.forEach(element => {
              if (!element.isCorrect) {
                  this.notCorrect [i] = element.abv;
                  i++;

              }
          });
          console.log(this.notCorrect);
      },
      returnMissions(){
          this.$router.push('/Missions');
      }
  },
  created(){
     this.getQsts(0);
   //  this.streak();
  }
}
</script>
