/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import App from  './vue/app'
import Missions from  './vue/missions'
import Communication from  './vue/communication'
import Teamwork from  './vue/teamwork'
import Home from  './vue/home'
import FirstTest from  './vue/testLvl'
//import LeaderBoard from  './vue/leaderBoard'
import Multi1 from  './vue/multi1'
import Accuracy1 from  './vue/accuracy1'
import Details1 from './vue/details1'
import Accuracy2 from  './vue/accuracy2'

window.Vue = require('vue').default;
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
  const router = new VueRouter({
  routes: [
      { path: '/', name: 'Home', component: Home },
      { path: '/testLvl', name: 'TestLvl', component: FirstTest },
      { path: '/missions', name: 'Missions', component: Missions },
      { path: '/mission1', name: 'Mission1', component: Communication },
      { path: '/mission2', name: 'Mission2', component: Teamwork },
      { path: '/multi1', name: 'Multi1', component: Multi1 },
      { path: '/accuracy1', name: 'Accuracy1', component: Accuracy1 },
      { path: '/details1', name: 'Details1', component: Details1 },
      { path: '/accuracy2', name: 'Accuracy2', component: Accuracy2 }
  ],
  mode: 'history'
});

const app = new Vue({
    el: '#app',
    router,
    components: { App }
});

