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
//import {store} from './store';
import store from './stores/global-store';

Vue.use(VueRouter);

const userListComponent = Vue.component('user-list',require('./components/userList.vue'));

const user = Vue.component('user',require('./components/user.vue'));
const profile = Vue.component('profile', require('./components/profile.vue'));
const login = Vue.component('login',require('./components/login.vue'));
const logout = Vue.component('logout',require('./components/logout.vue'));
const register = Vue.component('register',require('./components/register.vue'));


const routes=[
    {path:'/',redirect:'/users' ,name:'root'},
    {path:'/users',component:user, name:'users'},
    {path:'/list',component:userListComponent,name:'userList'},
    {path:'/profile',component:profile,name:'profile'},
    {path:'/login',component:login,name:'login'},
    {path:'/logout',component:logout,name:'logout'},
    {path:'/register',component:register,name:'register'}
    ];
const router = new VueRouter({
    routes 
    //routes:routes 
})

 router.beforeEach((to, from, next) => {
    if ((to.name == 'profile') || (to.name == 'logout')) {
        if (!store.state.user) {
            next("/login");
            return;
        }
    }
    next();
});

const app = new Vue({
   // el: '#app',
    //store:store,
    router,
    store,
    created(){
       /* console.log('--------------------');
        console.log(this.$store.state.user);*/
        this.$store.commit('loadTokenAndUserFromSession');
        //console.log(this.$store.state.user);
    }

}).$mount('#app');

