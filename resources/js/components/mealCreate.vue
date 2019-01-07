
<template>
	<div class="jumbotron">
	    <h2>Register Meal</h2>

		<div v-if="error" class="text-danger">
            <p>{{ error }}</p>
        </div>

        <div class="alert" :class="typeofmsg" v-if="showMessage">             
            <button type="button" class="close-btn" v-on:click="showMessage=false">&times;</button>
            <strong>{{ message }}</strong>
        </div>
	    <div class="form-group">
	        <label for="inputTable_Number">Table Number: </label>
					<input type="number" class="form-control" v-model="meal.table_number" placeholder="Number"/>
				<small v-if="errors.table_number" class="text-danger">{{ errors.table_number[0]}}</small>
	    </div>
	    <div class="form-group">
	        <label for="inputTotal_Price_Preview">Total price preview: </label>
	        <input
	            type="text" class="form-control" v-model="meal.total_price_preview"
	            name="total_price_preview" id="inputTotal_Price_Preview" 
	            placeholder="Price Preview"/>
				<small v-if="errors.total_price_preview" class="text-danger">{{ errors.total_price_preview[0]}}</small>
					
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
				errors:{},
				error:{},
				error: null
				}
			},
		    methods: {
		        createMeal: function(){
			    	this.showMessage = false;
	            	axios.post('api/meals',this.meal)
		                .then(response=>{
							this.error="";
		                	Object.assign(this.meal, response.data.data);
		                	this.typeofmsg = "alert-success";
	                        this.message = "Meal created correctly.";
							this.showMessage = true;
		                	//this.$emit('user-saved', this.user)
		                })
						.catch((error) => {
							this.error = error.response.data;
							errors = error.response.data;
		                	this.typeofmsg = "alert-danger";
	                        this.message = this.error;
	                        this.showMessage = true;
						})
				},
				cancelRegister: function(){
					this.$router.push('/meals');
				}

		    },
			mounted() {
		       
			}
};
</script>

<style>

</style>