<template>
    <div class="wrapper">
        <div class="lboard_section">
            <div class="lboard_tabs">
                <div class="tabs">
                    <ul>
                        <li data-li="today" id="todayTab" @click="change('today')">Today</li>
                        <li class="active" data-li="month" id="monthTab" @click="change('TopNewUsers')">Top New Users</li>
                        <li data-li="year" id="yearTab" @click="change('year')">Year</li>
                    </ul>
                </div>
            </div>

            <div class="lboard_wrap">
                <div class="lboard_item today" style="display: none;" id="todayItems">
                    <div class="lboard_mem">
                        <div class="img">
                            <img src="" alt="picture_1">
                        </div>
                        <div class="name_bar">
                            <p><span>1.</span> Charles John</p>
                        </div>
                        <div class="points">
                            195 points
                        </div>
                    </div>
                </div>
                <div class="lboard_item month" style="display: block;" id="monthItems">
                    <div v-for="(data, key) in usersNew">
                        <div class="lboard_mem">
                            <div class="img">
                                <img :src="'/uploads/'+data.img" style="border-radius:80%;">
                            </div>
                            <div class="name_bar d-flex">
                                <p> {{data.userName}} </p>
                                <img class="ml-1 mb-1" :src="'/uploads/'+data.imgLv" style="border-radius:50%;width:35px; height:35px">
                            </div>

                            <div class="points">
                                {{data.xp}} EXP
                            </div>
                        </div>
                    </div>

                </div>
                <div class="lboard_item year" style="display: none;" id="yearItems">
                    <div class="lboard_mem">
                        <div class="img">
                            <img src="" alt="picture_2">
                        </div>
                        <div class="name_bar">
                            <p><span>5.</span>Alex Mike</p>
                            <!--<div class="bar_wrap">
                                <div class="inner_bar" style="width: 10%"></div>
                            </div>-->
                        </div>
                        <div class="points">
                            2110 points
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
            usersNew: []
        }
    },
    methods:{
        getTopUsers(){
            axios.post('api/home/getTopUsers', {idUser:1})
                .then(response => {
                    console.log(response.data);
                    this.usersNew= response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        change (val) {
            var today = document.getElementById("todayTab");
            var month = document.getElementById("monthTab");
            var year = document.getElementById("yearTab");
            var tabs = [today, month, year];
            var todayItem = document.getElementById("todayItems");
            var monthItem = document.getElementById("monthItems");
            var yearItem = document.getElementById("yearItems");
            var items =  [todayItem, monthItem, yearItem];
                    tabs.forEach(function (item) {
                        item.classList.remove("active");
                    })
                    items.forEach(function (item) {
                        item.style.display = "none";
                    })
                    if (val == "today") {
                        today.classList.add("active");
                        todayItem.style.display = "block";
                    } else if (val == "month") {
                        month.classList.add("active");
                        monthItem.style.display = "block";
                    } else {
                        year.classList.add("active");
                        yearItem.style.display = "block";
                    }
        }
    },
    created(){
        this.getTopUsers();
    }
}
</script>

