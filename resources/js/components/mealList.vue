<template>
	<table class="table table-striped">
    	<thead>
	        <tr  v-if="meals.length > 0">
	            <th>ID</th>
	            <th>State</th>
	            <th>Table number</th>
	            <th>Start</th>
	            <th>Responsible Waiter</th>
				<th>Total Price Preview</th>
	            <th>Actions</th>
	        </tr>
			<tr v-else>
				<td>Não existem registos para orders</td>
			</tr>
	    </thead>
	    <tbody>
	        <tr v-if="meals.length > 0" v-for="meal in meals" :key ="meal.id" :class="{activerow: editingMeal === meal}">
	            <td>{{meal.id}}</td>
	            <td>{{meal.state}}</td>
	            <td>{{meal.table_number}}</td>
	            <td>{{meal.start}}</td>
	            <td>{{meal.responsible_waiter_id}}</td>
				<td>{{meal.total_price_preview}}</td>
				<div class="form-group">
					<button class="btn-primary" @click.prevent="summary(meal)">Summary</button>
					<a id="buttonStart" class="btn btn-danger" v-on:click.prevent="terminate(meal)">Terminate</a>
				</div>
	        </tr>   
	    </tbody>
	</table>

</template>

<script>
	module.exports ={
	props:["meals"],
		data: function(){
			return{
				editingMeal: null
			}
		},
		methods:{
			summary: function(meal){	
				this.editingMeal=meal;	
				this.$emit('meal-click',meal);
				this.editingMeal=null;
			},
			terminate: function(meal){	
				axios.patch('api/terminateMeal/'+meal.id, meal)
	                .then(response=>{
						console.log(response.data);
	                	Object.assign(meal, response.data);
						//this.$store.commit('setUser',response.data);
						this.$emit('meal-Terminated', meal);
	                });
			},
		},
		sockets: {
	        meal_terminated(terminatedMeal){
	        	let refToTerminatedMeal = this.getTerminatedMeal(terminatedMeal.id);
	        	if (refToTerminatedMeal !== null) {
	        		Object.assign(refToTerminatedMeal, terminatedMeal);
	        		this.changeStyleTemp(refToTerminatedMeal, "changed", 3000);
	        	}
	        },        	
        }
	}

</script>

<style>

</style>