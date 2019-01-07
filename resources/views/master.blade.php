<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Restaurant Manager</title>
        @yield('extrastyles') 
        <!-- Latest compiled and minified CSS & JS -->
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

        </head> 
        <body>
        <div class="container" id="app">
            <router-link to="/register" v-show="this.$store.state.user && this.$store.state.user.type=='manager'">Register Worker</router-link> #  
            <router-link to="/users" v-show="this.$store.state.user && this.$store.state.user.type=='manager'">Users</router-link> # 
            <router-link to="/dashboard" v-show="this.$store.state.user && this.$store.state.user.type=='manager'">Dashboard</router-link> # 
            <router-link to="/profile" v-show="this.$store.state.user">Profile</router-link> #
            <router-link to="/shift" v-show="this.$store.state.user">Shift</router-link> #
            <router-link to="/meals" v-show="this.$store.state.user">Meals</router-link> #
            <router-link to="/orders" v-show="this.$store.state.user">Orders</router-link> #
            <router-link to="/myOrders" v-show="this.$store.state.user">My Orders</router-link> #
            <router-link to="/items">Items</router-link> #
            <router-link to="/tables">Tables</router-link> #
            <router-link to="/login"  v-show="!this.$store.state.user">Login</router-link> #
            <router-link to="/logout" v-show="this.$store.state.user">Logout</router-link>
            <br>
              <em>User: @{{this.$store.state.user != null ? this.$store.state.user.name : " - None - " }}</em>
            <hr> 
              <div>
                <input type="text" id="inputManager" class="inputchat" v-model="msgManagerText" @keypress.enter="sendManagerText">
              </div>

              <div>
                <textarea id="textManager" class="inputchat"
                v-model="msgManagerTextArea">Manager notifications</textarea>
              </div>
            </hr> 
        <router-view></router-view>
        @section('pagescript')
        <script src="js/vue.js"></script>
        @stop  
        </div>
     @yield('pagescript')        
    </body>
</html>
