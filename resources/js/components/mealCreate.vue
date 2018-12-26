
<template>
	<div class="jumbotron">
	    <h2>Register Worker</h2>

        <div class="alert" :class="typeofmsg" v-if="showMessage">             
            <button type="button" class="close-btn" v-on:click="showMessage=false">&times;</button>
            <strong>{{ message }}</strong>
        </div>
	    <div class="form-group">
	        <label for="inputName">Table Number: </label>
	        <input
	            type="text" class="form-control" v-model="meal.name"
	            name="name" id="inputName" 
	            placeholder="Fullname"/>
	    </div>
	    <div class="form-group">
	        <label for="inputUsername">Total price preview: </label>
	        <input
	            type="text" class="form-control" v-model="meal.username"
	            name="userName" id="inputUsername" 
	            placeholder="Username"/>
	    </div>
	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="createMeal()">Register</a>
	        <a class="btn btn-danger" v-on:click.prevent="cancelRegister()">Cancel</a>
	    </div>
	</div>
</template>

<script>
	module.exports ={
			data:function(){ 
		 		return {
		 			meal:{	 				
				        table_number:"",
				        total_price_preview:"",
		 			},
                typeofmsg: "alert-success",
                showMessage: false,
                message: "",
			    }
			},
		    methods: {
		        createMeal: function(){
			    	this.showMessage = false;
	            	axios.post('api/meals')
		                .then(response=>{
		                	Object.assign(this.meal, response.data.data);
		                	this.typeofmsg = "alert-success";
	                        this.message = "Meal created correctly.";
	                        this.showMessage = true;
		                	//this.$emit('user-saved', this.user)
		                }).catch(error=>{
							swal(response.status.toString, response.body.error, "error");
	                        this.typeofmsg = "alert-danger";
	                        this.message = "Error creating meal.";
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