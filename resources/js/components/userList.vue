<template>
	<table class="table table-striped">
    	<thead>
	        <tr>
	            <th>ID</th>
	            <th>Name</th>
	            <th>Username</th>
	            <th>Email</th>
	            <th>Type</th>
	            <th>Blocked</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="user in users" :key ="user.id" :class="{activerow: editingUser === user}">
	            <td>{{user.id}}</td>
	            <td>{{user.name}}</td>
	            <td>{{user.username}}</td>
	            <td>{{user.email}}</td>
	            <td>{{user.type}}</td>
	            <td>{{user.blocked}}</td>
	            <td>
	                <button class="btn-primary" @click.prevent="editUser(user)">EDIT</button>
	                <button class="btn-danger" v-on:click.prevent="deleteUser(user)">DELETE</button>
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
				editingUser: null
			}
		},
		methods:{
			editUser: function(user){
				this.editingUser=user;			
				this.$emit('edit-click',user);
				this.editingUser=null;
			},
			deleteUser: function(user){
				this.editingUser=null;
				this.$emit('delete-click',user);
				this.editingUser=null;
			}	
		}
	}

</script>

<style>

</style>