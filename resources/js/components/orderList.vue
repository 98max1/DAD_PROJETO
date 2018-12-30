<template>
	<div class="jumbotron">
		<div v-if="error" class="text-danger">
            <h3>{{ error }}</h3>
        </div>

		<table class="table table-striped">
			<thead>
				<tr  v-if="ordersWaiter.length > 0">
					<th>ID</th>
					<th>State</th>
					<th>Item id</th>
					<th>Meal id</th>
					<th>Start</th>
					<th>End</th>
					<th>Action</th>
				</tr>
				<tr v-else>
					<td>Não existem registos para orders</td>
				</tr>
			</thead>
			<tbody v-for="orderWaiter in ordersWaiter" :key ="orderWaiter.id">
					<tr id="ordersConfirmed" v-if="orderWaiter.state == 'confirmed'">
						<td>{{orderWaiter.id}}</td>
						<td>{{orderWaiter.state}}</td>
						<td>{{orderWaiter.item_id}}</td>
						<td>{{orderWaiter.meal_id}}</td>
						<td>{{orderWaiter.start}}</td>
						<td>NULL</td>
						<td>NULL</td>
					</tr>
					<tr  id="ordersPending" v-if="orderWaiter.state == 'pending'">
						<td>{{orderWaiter.id}}</td>
						<td>{{orderWaiter.state}}</td>
						<td>{{orderWaiter.item_id}}</td>
						<td>{{orderWaiter.meal_id}}</td>
						<td>{{orderWaiter.start}}</td>
						<td>NULL</td>
						<td>
							<div class="form-group">
								<a id="buttonDelete" class="btn btn-danger" v-on:click.prevent="deleteOrder(orderWaiter)">Delete</a>
							</div>
						</td>
					</tr>
					<tr  id="ordersConfirmed" v-if="orderWaiter.state == 'prepared'">
						<td>{{orderWaiter.id}}</td>
						<td>{{orderWaiter.state}}</td>
						<td>{{orderWaiter.item_id}}</td>
						<td>{{orderWaiter.meal_id}}</td>
						<td>{{orderWaiter.start}}</td>
						<td>NULL</td>
						<td>
							<div class="form-group">
								<a id="buttonStart" class="btn btn-success" v-on:click.prevent="deliver(orderWaiter)">Deliver</a>
							</div>
						</td>
					</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	module.exports ={
	props:["ordersWaiter"],
		data: function(){
			return{

				 typeofmsg: "alert-success",
                showMessage: false,
				message: "",
				errors:{},
				error:{},
				error: null,



				editingOrder: null,
			}
		},
		methods:{
			deliver: function(orderWaiter){
				//this.user.last_shift_start= new Date();
				//this.user.shift_active= 1;
	            axios.patch('api/orderDeliver/'+orderWaiter.id, orderWaiter)
	                .then(response=>{
						console.log(response.data);
	                	Object.assign(orderWaiter, response.data);
						//this.$store.commit('setUser',response.data);
						this.$emit('order-Deliver', orderWaiter);
	                });
			},
			deleteOrder: function(orderWaiter){
				//this.user.last_shift_start= new Date();
				//this.user.shift_active= 1;
	            axios.delete('api/orderDelete/'+orderWaiter.id, orderWaiter)
	                .then(response=>{
						console.log(response.data);
	                	Object.assign(orderWaiter, response.data);
						//this.$store.commit('setUser',response.data);
						this.$emit('order-Delete', orderWaiter);
					})
					.catch((error) => {
							this.error = error.response.data;
							errors = error.response.data;
		                	this.typeofmsg = "alert-danger";
	                        this.message = this.error;
	                        this.showMessage = true;
						});
			}
		},
		mounted(){
			console.log("asdasd");
		}
	}

</script>

<style>
#ordersConfirmed{
	color: green !important;
}
#ordersPending{
	color: red !important;
}
#buttonDelete{
	color:white;
}
</style>