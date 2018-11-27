<!--  
<template v-if="isLoggedIn">
	<div id="register">
        <h1>Register Worker</h1>
        <p>
        	NAME
        	<input type="text" name="name" v-model="name" placeholder="Name" />
        </p>
        <p>
        	USERNAME
        	<input type="text" name="username" v-model="username" placeholder="Username" />
        </p>
        <p>
        	EMAIL
        	<input type="text" name="email" v-model="email" placeholder="Email" />
        </p>
        <p>
        	PASSWORD
        	<input type="password" name="password" v-model="password" placeholder="Password" />
        </p>
        <p>
        	TYPE
        	<input type="text" name="type" v-model="type" placeholder="type" />
        </p>
        <p>
        	BLOCKED STATUS
        	<input type="text" name="blocked" v-model="blocked" placeholder="blocked" />
        </p>
        <p>
        	PHOTO
        	<input type="text" name="photo" v-model="photo_url" placeholder="Photo" />
        </p>
        <button type="button" v-on:click="register" value="submit">Submit</button>
	</div>
</template>-->
<template>
	<div class="jumbotron">
	    <h2>Register Worker</h2>
	    <div class="form-group">
	        <label for="inputName">Name: </label>
	        <input
	            type="text" class="form-control" v-model="user.name"
	            name="name" id="inputName" 
	            placeholder="Fullname"/>
	    </div>
	    <div class="form-group">
	        <label for="inputUsername">Username: </label>
	        <input
	            type="text" class="form-control" v-model="user.username"
	            name="userName" id="inputUsername" 
	            placeholder="Username"/>
	    </div>
	    <div class="form-group">
	        <label for="inputEmail">Email: </label>
	        <input
	            type="email" class="form-control" v-model="user.email"
	            name="email" id="inputEmail"
	            placeholder="Email address"/>
	    </div>
	    <div class="form-group">
	        <label for="inputEmail">Password: </label>
	        <input
	            type="password" class="form-control" v-model="user.password"
	            name="password" id="inputPassword"
	            placeholder="Password"/>
	    </div>
	  	<div class="form-group">
	        <label for="inputType">Type: </label>
	        <select class="form-control" id="inputType" name="type" v-model="user.type" >
	        	<option value="" selected disabled hidden>Select Type of Worker</option>
	            <option> Manager </option>
	            <option> Cook </option>
	            <option> Cashier </option> 
	            <option> Waiter </option> 
	        </select>
	    </div>

	  	<div class="form-group">
	        <label for="inputBlocked">Blocked Status: </label>
	        <select class="form-control" id="inputBlocked" name="blocked" v-model="user.blocked" >
	        	<option value="" selected disabled hidden>Select Blocked Status</option>
	            <option v-bind:value="1"> 1 (Blocked) </option>
	            <option v-bind:value="0"> 0 (Free) </option>
	        </select>
	    </div>

	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="register()">Register</a>
	        <a class="btn btn-danger" v-on:click.prevent="cancelRegister()">Cancel</a>
	    </div>
	</div>
</template>

<script>
	module.exports ={
			data:function(){ 
		 		return {
		 			user:{	 				
				        name:"",
				        username:"",
				        email:"",
				        password:"",
				        type:"",
				        blocked:"",
						//success:""
		 			}
			    }
			},
		    methods: {
		        register: function(){
		            axios.post('api/users',this.user)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
	                	// without creating a new reference
	                	Object.assign(this.user, response.data.data);
	                	//this.$emit('user-saved', this.user)
	                }).catch(error=>{
	                	console.log(error);
	                });
		        },
		        lolao: function(){
		        	console.log(this.user);
		        }

		    },
			mounted() {
		       
			}
};
</script>

<style>

</style>