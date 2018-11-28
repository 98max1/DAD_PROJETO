@extends('master')

@section('title', 'Restaurant Manager')

@section('content')

<!--  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">AWAWWA <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Shift <span class="sr-only"></span></a>
      </li>
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">All my notifications</a>
            <a class="dropdown-item" href="#">Send notification</a>
            </div>
        </li>
    </ul>
-->
    <router-link to="/register" v-show="this.$store.state.user && this.$store.state.user.type=='manager'">Register Worker</router-link> #  
    <router-link to="/users" v-show="this.$store.state.user && this.$store.state.user.type=='manager'">Users</router-link> # 
    <router-link to="/profile" v-show="this.$store.state.user">Profile</router-link> #
    <router-link to="/login"  v-show="!this.$store.state.user">Login</router-link> #
    <router-link to="/logout" v-show="this.$store.state.user">Logout</router-link>
    
    <br>
      <em>User: @{{this.$store.state.user != null ? this.$store.state.user.name : " - None - " }}</em>
    <hr> <!--
    <form class="form-inline my-2 my-lg-0">
     <a class="dropdown-item" >
        <button type="button" v-on:click="remove" value="submit">Logout</button>
      </a>  -->
     <!-- <div>
          <ul class="navbar-nav mr-auto" v-if="!$store.isLoggedIn">
                  <router-link to="/login"> Login </router-link>
          </ul>
          <ul class="navbar-nav mr-auto" v-else>
          <li class="nav-item dropdown" >
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item">
                  <router-link to="/register">Register Worker</router-link>
                </a> -->
                <!-- # ↑ A alterar mais tarde  ↓ # -->
              
<!-- 
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Change password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" >
                  <router-link to="/logout">Logout</router-link>
                </a>
              </div>
          </li>

          </ul>
      </div>
      <div>
          <ul class="navbar-nav mr-auto" >
                  <router-link to="/register"> #Register </router-link>
          </ul>
      </div>
    </form>
  </div>
</nav>
 -->
<router-view></router-view>

@endsection
@section('pagescript')
<script src="js/vue.js"></script>
@stop  
