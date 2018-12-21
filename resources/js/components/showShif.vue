<template>
	<table class="table table-striped" >
    	<thead>
	        <tr>
	            <th>ID</th>
	            <th>Name</th>
	            <th>Username</th>
	            <th>Star shift</th>
	            <th>Type</th>
	            <th>Blocked</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr>
	            <td>{{user.id}}</td>
	            <td>{{user.name}}</td>
	            <td>{{user.username}}</td>
	            <td>{{user.shift_active}}</td>
	            <td>{{user.type}}</td>
	            <td>{{user.blocked}}</td>
	            <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="saveUser()">Save</a>
	        <a class="btn btn-light" v-on:click.prevent="cancelEdit()">Cancel</a>
	    </div>
	        </tr>   
	    </tbody>
	</table>

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