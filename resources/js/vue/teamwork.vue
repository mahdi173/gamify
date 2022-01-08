<template>
<div>
  <div class="container mt-5">
    <div class="d-flex justify-content-center row">
      <div class="col-md-10 col-lg-10">
        <div class="container bg-white p-3">

                   <div class="raw">
                           <div class="d-flex">
                               <div class="col-5">
                               <div class="monkeySad" id="mkimg"> </div>
                               </div>
                               <div class="col">
                               <div class="" id="bn1"></div>
                               <div class=""  id="bn2"></div>
                               </div>
                               <div class="col">
                               <div class=""  id="bn3"></div>
                               <div class=""  id="bn4"></div>
                               </div>
                               <div class="col">
                               <div class=""  id="bn5"></div>
                               </div>
                           </div>
                   </div>
            <div class="raw">
               <div  class="col-sm">
                  <div class="border">
                    <div class="border mb-3">
                      <div class="ml-1 mt-2 mr-1 mb-2">
                                   {{question[0].contenuQst}}
                          <h4 style="float: right;"> <i class="bi bi-stopwatch"><sub> {{count}}</sub></i> </h4>
                      </div>
                    </div>
                      <div class=" btn-group ans ml-2 mt-2" v-for="(data, key) in question">
                          <button class="btn card bg-light" style="width: 250px; height:100px;" :id="data.abv" :value="data.contenu" @click="change(data.abv)">
                                {{data.contenu}}
                            </button>
                      </div>
                      <div class="border mb-5">
                         <button class="btn  bg-primary mt-2 mr-1" style="float:right;" @click="postAns()"> Next </button>
                      </div>
                  </div>
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
       question: [],
         count: 30
     }
  },
  methods:{
    getNv2 (){
      axios.get('api/questions/getQstNv2')
      .then( response=> {
           this.question= response.data;
          this.count=30; //redefinition
           this.timer(); // appelle
        /*  if(this.page==3){ // if we hit max of  questions
              this.$router.push('/Missions');// redirection
          }*/
        })
      .catch( error=> { console.log(error);
       })
    },
    change(idBtn){
     var btn = document.getElementById(idBtn);
        if(btn.classList.contains('bg-light')){
               btn.classList.replace('bg-light','bg-danger');
        }else if (btn.classList.contains('bg-danger')){
               btn.classList.replace('bg-danger','bg-success');
        }else if (btn.classList.contains('bg-success')){
               btn.classList.replace('bg-success','bg-primary');
        }else if (btn.classList.contains('bg-primary')){
               btn.classList.replace('bg-primary','bg-warning');
        }else if (btn.classList.contains('bg-warning')){
               btn.classList.replace('bg-warning','bg-secondary');
        }else if (btn.classList.contains('bg-secondary')){
               btn.classList.replace('bg-secondary','bg-light');
        }
         // console.log(btn.classList)
    },
     postAns (){
      var th1 = document.getElementById('Tache1').className;
      var th2 = document.getElementById('Tache2').className;
      var th3 = document.getElementById('Tache3').className;
      var th4 = document.getElementById('Tache4').className;
      var th5 = document.getElementById('Tache5').className;

         var monkey = document.getElementById('mkimg');
         var bn1 = document.getElementById('bn1');
         var bn2 = document.getElementById('bn2');
         var bn3 = document.getElementById('bn3');
         var bn4 = document.getElementById('bn4');
         var bn5 = document.getElementById('bn5');

         var tabBn= [bn1, bn2, bn3, bn4, bn5];

       var tabTaches= [th1, th2, th3, th4, th5];
      // Put all array elements in a map
        let s = new Set();
        for (let i = 0; i < tabTaches.length; i++) {
           if(!tabTaches[i].includes('bg-light')){
            s.add(tabTaches[i]);
          }
        }

        if (s.size == tabTaches.length) {
          axios.post('api/questions/ans1Nv2', {rep: tabTaches})
          .then( response=> {
               console.log(response.data);
               if(response.data>=3){
                   monkey.classList.replace('monkeySad','monkeyHappy');
               }else{

               }
              for (let i = 0; i < response.data; i++) {
                  tabBn[i].classList.add('banana');
              }
            })
          .catch( error=> { console.log("error");
           })
        }
    },
      timer(){
          setTimeout(this.countDown,1000);
      },
      countDown(){
          this.count=this.count-1;
          if(this.count==0){
              //this.getQsts(this.page=this.page+1);
              //console.log(this.page);
              this.$router.push('/Missions');// redirection
          }else{
              this.timer();
          }
      }
  },
  created(){
     this.getNv2();
      //this.timer();
  }
}
</script>
