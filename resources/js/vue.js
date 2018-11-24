/*jshint esversion: 6 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//const VueRouter = require('vue-router');
import VueRouter from 'vue-router';

Vue.use(VueRouter);
const userListComponent = Vue.component('user-list',require('./components/userList.vue'));

const users = Vue.component('users',require('./components/users.vue'));

const registerWorker = Vue.component('register',require('./components/registerWorker.vue'));
const routes=[
    {path:'/',redirect:'/users' },
    {path:'/users',component:users},
    {path:'/list',component:userListComponent},
    {path:'/register',component:registerWorker}
    ];
const router = new VueRouter({
    routes 
    //routes:routes 
})
const app = new Vue({
    el: '#app',
    router
});
