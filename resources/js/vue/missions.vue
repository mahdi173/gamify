<template>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="border">

                <div class="question bg-white p-5 border-bottom mx-auto">

                    <div class=" btn-group  mx-auto">
                        <div class="col-sm-5">
                         <button class="btn btn-light btn-lg  mr-1"  @click="goMis1()"> <strong>Communication</strong> </button>
                        </div>
                        <div class="col-sm-5">
                        <button class="btn btn-light btn-lg  mr-1"  @click="goMis2()"> <strong>Team Work</strong>    </button>
                        </div>

                        <div class="col-sm-5">

                            <button class="btn btn-light btn-lg  mr-1" @click="goMis3()"> <strong>Intelligence</strong>    </button>
                        </div>

                        <!-- <button class="btn btn-light btn-lg  mr-1" @click="goMis4()">  Compétances  </button> -->
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-10 col-lg-10">
            <LeaderBoard />

        </div>

        </div>
</div>

</template>

<script>
import LeaderBoard from  './leaderBoard'

export default{
    components: {
        LeaderBoard
    },
  methods:{
    goMis1 (){
       this.$router.push('/Mission1');
    },
    goMis2(){
        this.$router.push('/Mission2');
    },
    goMis3(){
        this.$router.push('/Accuracy1');
    }
  },
  created(){
  }
}
</script>
