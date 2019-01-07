@extends('master')

@section('title', 'Restaurant Manager')

@section('content')

    <router-link to="/register" v-show="this.$store.state.user && this.$store.state.user.type=='manager'">Register Worker</router-link> #  
    <router-link to="/users" v-show="this.$store.state.user && this.$store.state.user.type=='manager'">Users</router-link> # 
    <router-link to="/dashboard" v-show="this.$store.state.user && this.$store.state.user.type=='manager'">Dashboard</router-link> # 
    <router-link to="/profile" v-show="this.$store.state.user">Profile</router-link> #
    <router-link to="/shift" v-show="this.$store.state.user">Shift</router-link> #
    <router-link to="/meals" v-show="this.$store.state.user">Meals</router-link> #
    <router-link to="/orders" v-show="this.$store.state.user">Orders</router-link> #
    <router-link to="/invoices" v-show="this.$store.state.user.type=='cashier'">Invoices</router-link> #
    <router-link to="/statistics" v-show="this.$store.state.user">Statistics</router-link> #
    <router-link to="/items">Items</router-link> #
    <router-link to="/tables">Tables</router-link> #
    <router-link to="/login"  v-show="!this.$store.state.user">Login</router-link> #
    <router-link to="/logout" v-show="this.$store.state.user">Logout</router-link>
    <br>
      <em>User: @{{this.$store.state.user != null ? this.$store.state.user.name : " - None - " }}</em>
    <hr> 
      <h4>Send message to managers</h4>
      <div>
        <input type="text" id="inputManager" class="inputchat" v-model="msgManagerText" @keypress.enter="sendManagerText">
      </div>

      <div>
        <textarea id="textManager" class="inputchat"
        v-model="msgManagerTextArea">Manager notifications</textarea>
      </div>
    </hr> 
<router-view></router-view>

@endsection
@section('pagescript')
<script src="js/vue.js"></script>
@stop  