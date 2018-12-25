
<template>
<div>
    <div class="alert" :class="typeofmsg" v-if="showMessage">             
        <button type="button" class="close-btn" v-on:click="showMessage=false">&times;</button>
        <strong>{{ message }}</strong>
    </div>
	<div class="jumbotron">
	    <h2>Forgot Password?</h2>
	    <div class="form-group">
	        <label for="inputEmail">Email: </label>
	        <input
	            type="email" class="form-control" v-model.trim="user.email"
	            name="email" id="inputEmail"
	            placeholder="Email address"/>
	    </div>
	  
	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="reset">Confirm</a>
            <router-link class="btn btn-danger" to="/login">Cancel</router-link>
	        
	    </div>
	</div>
</div>	
</template>

<script>
	module.exports ={
			data:function(){ 
		 		return {
		 			user:{
		 				email:"",
		 			},
	                typeofmsg: "alert-success",
	                showMessage: false,
	                message: "",
			    }
			},
		    methods: {
		        reset(){
			    	this.showMessage = false;
	            	axios.post('api/reset',this.user)
		                .then(response=>{
		                	this.typeofmsg = "alert-success";
	                        this.message = "Reset mail successfuly sent!";
	                        this.showMessage = true;
		                	//this.$emit('user-saved', this.user)
		                }).catch(error=>{
	                        this.typeofmsg = "alert-danger";
	                        this.message = "Error sending reset mail!";
	                        this.showMessage = true;
		                });
		        }

		    },
			mounted() {
		       
			}
};
</script>

<style>

</style>