<template>
	<table class="table table-striped">
    	<thead>
	        <tr>
	            <th>Name</th>
	            <th>Email</th>
	            <th>Age</th>
	            <th>Department</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="(user,index) in users" :key ="user.id">
	            <td>{{user.name}}</td>
	            <td>{{user.email}}</td>
	            <td>{{user.age}}</td>
	            <td>{{user.department}}</td>
	            <td>
	                <button @click.prevent="editUser(user)">EDIT</button>
	                <button v-on:click.prevent="deleteUser(user,index)">DELETE</button>
	            </td>
	        </tr>   
	    </tbody>
	</table>

</template>

<script>
	module.exports ={
	props:["users"],
		data: function(){
			return{

			}
		},
		methods:{
			editUser: function(user,index){
				this.$emit('edit-user',user,index);
			},
			deleteUser: function(user,index){
				this.$emit('delete-user',user,index);

			}	
		}
	}

</script>

<style>

</style>