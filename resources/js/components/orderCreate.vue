
<template>
	<div class="jumbotron">
		<h2>Register Order</h2>
		<div class="alert" :class="typeofmsg" v-if="showMessage">             
            <button type="button" class="close-btn" v-on:click="showMessage=false">&times;</button>
            <strong>{{ message }}</strong>
        </div>

	    <table class="table table-striped">
			<tbody>
				<div class="form-group">
					<label for="inputMeal">Select Meal: </label><br>
					<select v-model="order.meal_id" class="form-control" id="inputMeal" name="meal" >
						<option disabled value="">Please select one meal</option>
						<option v-for="meal in meals" :key="meal.id"  v-bind:value="meal.id">
							Id: {{meal.id}} | Table: {{meal.table_number}} | Start time: {{meal.start}} | Total Price: {{meal.total_price_preview}}
						</option>
					</select>
				</div>

				<div class="form-group">
					<label for="inputItem">Select Item: </label><br>
					<select v-model="order.item_id" class="form-control" id="inputItem" name="item" >
						<option disabled value="">Please select one item</option>
						<option v-for="item in items" :key="item.id" v-bind:value="item.id">
								Id: {{item.id}} | Name: {{item.name}} | Type: {{item.type}} | Price: {{item.price}}
						</option>
					</select>
				</div>


				
			</tbody>
		</table>
		<div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="createOrder()">Create</a>
	        <a class="btn btn-danger" v-on:click.prevent="cancelRegister()">Cancel</a>
	    </div>
	</div>
</template>


<script>
	module.exports ={
			data:function(){ 
		 		return {
					order:{},
					meals: [],
					items: [], 
					typeofmsg: "alert-success",
					showMessage: false,
					message: "",
					errors:{},
					error:{},
					selectedMeal: 'Select one',
					error: null,
					picked: ''
				}
			},
		    methods: {
		        createOrder: function(){
			    	this.showMessage = false;
	            	axios.post('api/orders',this.order)
		                .then(response=>{
							this.error="";
		                	Object.assign(this.order, response.data.data);
		                	this.typeofmsg = "alert-success";
	                        this.message = "Order created correctly.";
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
					this.$router.push('/orders');
				}
			},
			created(){
				axios.get('api/itemsAll')
					.then(response=>{this.items = response.data.data; });
				
				axios.get('api/meals')
					.then(response=>{this.meals = response.data.data; });				
			},
			mounted() {
		       
			}
};
</script>

<style>

</style>