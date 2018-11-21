@extends('master')

@section('title', 'Vue.js App')

@section('content')

<router-view></router-view>

<nav class="navbar navbar-dark bg-dark">
<router-link to="/users">Users</router-link>
<router-link to="/list">List</router-link>  
</nav>
@endsection
@section('pagescript')
<script src="js/vue.js"></script>
@stop  
