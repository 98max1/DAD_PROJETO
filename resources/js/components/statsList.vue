<template>
	<div class="jumbotron">
		<div v-if="error" class="text-danger">
            <h3>{{ error }}</h3>
        </div>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>State</th>
					<th>Item id</th>
					<th>Meal id</th>
					<th>Start</th>
					<th>End</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody v-for="user in users" :key ="user.id">
					<tr v-if="user.type == 'cook' " id="cook">
						<td>{{user.id}}</td>
						<td>{{count_orders_Cook(user)}}</td>
						<td></td>
						<td>NULL</td>
					</tr>
					<tr v-if="user.type == 'waiter'" id="waiter">
						<td>{{user.id}}</td>
						<td>{{count_meal_Waiter(user)}}</td>
						<!--<td>{{count_orders_Waiter(user)}}</td>-->
						<td></td>
						<td>NULL</td>
					</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	module.exports ={
	props:["users"],
		data: function(){
			return{
				typeofmsg: "alert-success",
                showMessage: false,
				message: "",
				errors:{},
				error:{},
				error: null,
				total_orders: null,
				total_meals: null,
				editingOrder: null,
			}
		},
		methods:{
			count_orders_Cook: function(user){
				axios.get('api/countOrdersCook/'+user.id, user)
                    .then(response=>{
						this.total_orders = response.data; 
						//console.log(this.total_orders);
					});
				//return this.total_orders;
			},
			
			count_meal_Waiter: function(user){
				axios.get('api/countMealWaiter/'+user.id, user)
                    .then(response=>{
						this.total_meals = response.data; 
						//console.log(this.total_orders);
					});
				//return this.total_orders;
			},
			
			count_orders_Waiter: function(user){
				axios.get('api/countOrdersWaiter/'+user.id, user)
                    .then(response=>{
						this.total_orders = response.data; 
						//console.log(this.total_orders);
					});
				//return this.total_orders;
            },
		},
		mounted(){
			console.log("asdasd");
		}
	}

</script>

<style>
#waiter{
	color: green !important;
}
#cook{
	color: red !important;
}
#buttonDelete{
	color:white;
}
</style>