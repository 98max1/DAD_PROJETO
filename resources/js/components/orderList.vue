<template>
	<table class="table table-striped">
    	<thead>
	        <tr  v-if="ordersWaiter.length > 0">
	            <th>ID</th>
	            <th>State</th>
	            <th>Item id</th>
	            <th>Meal id</th>
	            <th>Responsible Cook</th>
	            <th>Start</th>
				<th>End</th>
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
					<td>{{orderWaiter.responsible_cook_id}}</td>
					<td>{{orderWaiter.start}}</td>
					<td>NULL</td>
				</tr>
				<tr  id="ordersPending" v-if="orderWaiter.state == 'pending'">
					<td>{{orderWaiter.id}}</td>
					<td>{{orderWaiter.state}}</td>
					<td>{{orderWaiter.item_id}}</td>
					<td>{{orderWaiter.meal_id}}</td>
					<td>{{orderWaiter.responsible_cook_id}}</td>
					<td>{{orderWaiter.start}}</td>
					<td>NULL</td>
				</tr>
	</tbody>
	</table>
	

</template>

<script>
	module.exports ={
	props:["ordersWaiter"],
		data: function(){
			return{
				editingOrder: null
			}
		},
		methods:{
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
</style>