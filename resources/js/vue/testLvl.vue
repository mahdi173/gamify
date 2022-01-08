<template>
    <div>
        <div class="container mt-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-10 col-lg-10">
                    <div class="border">
                        <div class="question p-3 border-bottom"  style="background-color: #a0aec0" >
                            <div class="d-flex flex-row justify-content-between align-items-center mcq" >
                                    <h5 class="mt-1 ml-2">{{questions[0].contenuQst}}</h5>
                                <h4> <i class="bi bi-stopwatch"><sub> {{count}}</sub></i> </h4>
                            </div>
                        </div>
                        <div class="question bg-white p-5 border-bottom">
                            <div class="row">
                                <div class="col">
                                    <div class="btn-group ml-2 mt-3" v-for="(data, key) in questions">
                                        <label class="button"> <input type="button" class="btn btn-light btn-lg ml-5" :id="data.abv" :value="data.contenu" @click="postAns(data.abv)">
                                        </label>
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
            questions: [],
            page :0,
            count: 30
        }
    },
    methods:{
        getQsts (page){
            axios.post('api/questions/getQstsNv0', {page: page})
                .then( response=> {
                    this.questions= response.data;
                    this.count=30;
                    this.timer();
                    if(this.page==5){
                        this.$router.push('/Missions');
                    }
                })
                .catch( error=> { console.log(error);
                })
        },
        postAns(dataAbv){
            var rep = document.getElementById(dataAbv);
            axios.post('api/questions/AnsNv0', {rep: dataAbv} )
                .then(response => {
                    if(response.data){
                        rep.classList.add('bg-success');
                        window.setTimeout(function () {
                            rep.classList.remove('bg-success');
                        }, 1000);
                    }else{
                        rep.classList.add('bg-danger');
                        window.setTimeout(function () {
                            rep.classList.remove('bg-danger');
                        }, 1000);
                    }
                    this.getQsts(this.page+=1);
                    //console.log(this.page);
                    if(this.page==5){
                        this.$router.push('/Missions');
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
                 if(this.count==0 && this.page!=5){
                     this.getQsts(this.page=this.page+1);
                 }else{
                     this.timer();
                 }
        }
    },
    created(){
        this.getQsts(0);
    }
}
</script>
