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


import VueSocketio from 'vue-socket.io';
Vue.use(new VueSocketio({
    debug: true,
    connection: 'http://127.0.0.1:8080'
}));    

 import Toasted from 'vue-toasted';
 
  Vue.use(Toasted, {
    position: 'bottom-center',
    duration: 5000,
    type: 'info',
  });


const userListComponent = Vue.component('user-list',require('./components/userList.vue'));
const itemListComponent = Vue.component('item-list', require('./components/itemList.vue'));


const user = Vue.component('user',require('./components/user.vue'));
const profile = Vue.component('profile', require('./components/profile.vue'));
const shift = Vue.component('shift',require('./components/shift.vue'));
const login = Vue.component('login',require('./components/login.vue'));
const logout = Vue.component('logout',require('./components/logout.vue'));
const register = Vue.component('register',require('./components/register.vue'));
const item = Vue.component('item', require('./component/item.vue'));

const routes=[
    {path:'/',redirect:'/users' ,name:'root'},
    {path:'/users',component:user, name:'users'},
    {path:'/list',component:userListComponent,name:'userList'},
    {path:'/profile',component:profile,name:'profile'},
    {path:'/shift',component:shift,name:'shift'},
    {path:'/login',component:login,name:'login'},
    {path:'/logout',component:logout,name:'logout'},
    {path:'/register',component:register,name:'register'},
    {path:'/items', component:item, name:'items'},
    {path:'/itemList', component:itemListComponent, name:'itemList'}
    ];
const router = new VueRouter({
    routes:routes 
})

 router.beforeEach((to, from, next) => {
    if ((to.name == 'profile') || (to.name == 'logout')) {
        store.commit('loadTokenAndUserFromSession');
        
        if (!store.state.user) {
            console.log(store.state.user);
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
    },
    data:{
        msgGlobalText: "",
        msgGlobalTextArea: "",
        msgManagerText: "",
        msgManagerTextArea: "",
        player1:undefined,
        player2: undefined,
      },
      store,
      methods: {
        sendManagerText: function(){
            console.log('Sending to the server (only same department) this message: "' + this.msgManagerText + '"');
            if (this.$store.state.user === null) {
                this.$toasted.error('User is not logged in!');            
            } else {
                this.$socket.emit('text_from_worker_to_managers', this.msgManagerText, this.$store.state.user);
            }
            this.msgManagerText = "";
        }
    
      },
        sockets:{
            connect(){
                console.log('socket connected (socket ID = '+this.$socket.id+')');
            }, 
            msg_from_server(dataFromServer){
                console.log('Receiving this message from Server: "' + dataFromServer + '"');            
                this.msgGlobalTextArea = dataFromServer + '\n' + this.msgGlobalTextArea ;
            },  
            text_from_server_managers(dataFromServer){
                console.log('Receiving this message from Server: "' + dataFromServer + '"');            
                this.msgManagerTextArea = dataFromServer + '\n' + this.msgManagerTextArea ;
            },
            privateMessage(dataFromServer){
                let sourceName = dataFromServer[1] === null ? 'Unknown': dataFromServer[1].name;
                this.$toasted.show('Message "' + dataFromServer[0] + '" sent from "' + sourceName + '"');        
            },
            privateMessage_unavailable(destUser){
                this.$toasted.error('User "' + destUser.name + '" is not available');       
            },
            privateMessage_sent(dataFromServer){
                this.$toasted.success('Message "' + dataFromServer[0] + '" was sent to "' + dataFromServer[1].name + '"');
            },
            user_changed(dataFromServer){
                this.$toasted.show('User "' + dataFromServer.name + '" (ID= ' + dataFromServer.id + ') has changed');
            },
        },
      created() {
          console.log('-----');
          console.log(this.$store.state.user);
          this.$store.commit('loadDepartments');
          this.$store.commit('loadTokenAndUserFromSession');
          console.log(this.$store.state.user);
      }
}).$mount('#app');

