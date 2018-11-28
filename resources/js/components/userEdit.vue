<template>
	<div class="jumbotron">
	    <h2>Edit User</h2>
	    <div class="form-group">
	        <label>Id</label>
	        <label type="text" class="form-control" name="id" placeholder="Id"> {{user.id}}</label>
	    </div>
	    <div class="form-group">
	        <label for="inputName">Name</label>
	        <input
	            type="text" class="form-control" v-model="user.name"
	            name="name" id="inputName" 
	            placeholder="Fullname"/>
	    </div>
	    <div class="form-group">
	        <label for="inputUsername">Username</label>
	        <input
	            type="text" class="form-control" v-model="user.username"
	            name="userName" id="inputUsername" 
	            placeholder="Username"/>
	    </div>
	    <div class="form-group">
	        <label for="inputEmail">Email</label>
	        <input
	            type="email" class="form-control" v-model="user.email"
	            name="email" id="inputEmail"
	            placeholder="Email address"/>
	    </div>

	    <div class="form-group">
	        <label>Type</label>
	        <label type="text" class="form-control" name="type" placeholder="Type"> {{user.type}}</label>
	    </div>

	    <div class="form-group">
	        <label>Change Password</label>
	        <input
	            type="password" class="form-control"
	            name="password" id="inputPassword"
	            placeholder="New Password"/>
	    </div>
	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="saveUser()">Save</a>
	        <a class="btn btn-light" v-on:click.prevent="cancelEdit()">Cancel</a>
	    </div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
		props: ['user'],
	    methods: {
	        saveUser: function(){
	            axios.put('api/users/'+this.user.id, this.user)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
	                	// without creating a new reference
	                	Object.assign(this.user, response.data.data);
	                	this.$emit('user-saved', this.user)
	                });
	        },
	        cancelEdit: function(){
	        	axios.get('api/users/'+this.user.id)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
	                	// without creating a new reference
	                	Object.assign(this.user, response.data.data);
	                	this.$emit('user-canceled', this.user);
	                });
	        }
		}
	}
</script>

<style scoped>	
.label{
	color: red,
}
</style>