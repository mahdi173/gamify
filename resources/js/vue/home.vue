<template>
<div class="container mt-5">
  <div class="d-flex justify-content-center row">
      <div class="col-md-10 col-lg-10">

          <button class="btn btn-warning btn-lg  mr-2 ml-5" @click="goMissions()">  Start  </button>


      </div>
  </div>
</div>
</template>

<script>

export default{
  methods:{
    goMissions(){
        this.$router.push('/Missions');
     //this.$router.push('/TestLvl');
     //this.$router.push('/LeaderBoard');
    }
  }
}
</script>
