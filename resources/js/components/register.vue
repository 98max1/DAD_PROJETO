
<template>
	<div class="jumbotron">
	    <h2>Register Worker</h2>

        <div class="alert" :class="typeofmsg" v-if="showMessage">             
            <button type="button" class="close-btn" v-on:click="showMessage=false">&times;</button>
            <strong>{{ message }}</strong>
        </div>
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
		 			},
                typeofmsg: "alert-success",
                showMessage: false,
                message: "",
			    }
			},
		    methods: {
		        register: function(){
			    	this.showMessage = false;
	            	axios.post('api/users',this.user)
		                .then(response=>{
		                	Object.assign(this.user, response.data.data);
		                	this.typeofmsg = "alert-success";
	                        this.message = "Worker resgistered correctly.";
	                        this.showMessage = true;
		                	//this.$emit('user-saved', this.user)
		                }).catch(error=>{
	                        this.typeofmsg = "alert-danger";
	                        this.message = "Error registering worker.";
	                        this.showMessage = true;
	                        console.log(error);
		                });
		        }

		    },
			mounted() {
		       
			}
};
</script>

<style>

</style>