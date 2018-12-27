<template>
	<table class="table table-striped">
    	<thead>
	        <tr>
	            <th>ID</th>
	            <th>State</th>
	            <th>Item id</th>
	            <th>Meal id</th>
	            <th>Responsible Cook</th>
	            <th>Start</th>
				<th>End</th>
	        </tr>
	    </thead>
	    <tbody>
			<tr id="ordersConfirmed"  v-for="orderConfirmed in ordersConfirmed" :key ="orderConfirmed.id">
				<td>{{orderConfirmed.id}}</td>
				<td>{{orderConfirmed.state}}</td>
				<td>{{orderConfirmed.item_id}}</td>
				<td>{{orderConfirmed.meal_id}}</td>
				<td>{{orderConfirmed.responsible_cook_id}}</td>
				<td>{{orderConfirmed.start}}</td>
				<td>NULL</td>
			</tr>  
			<tr id="ordersPending" v-if="ordersPending.length <= 0">
				<td>Não existem registos para pending orders</td>
			</tr>
			<tr id="ordersPending" v-else v-for="orderPending in ordersPending" :key ="orderPending.id">
				<td>{{orderPending.id}}</td>
				<td>{{orderPending.state}}</td>
				<td>{{orderPending.item_id}}</td>
				<td>{{orderPending.meal_id}}</td>
				<td>{{orderPending.responsible_cook_id}}</td>
				<td>{{orderPending.start}}</td>
				<td>NULL</td>
			</tr>  
	</tbody>
	</table>
	

</template>

<script>
	module.exports ={
	props:["ordersPending","ordersConfirmed"],
		data: function(){
			return{
				editingOrder: null
			}
		},
		methods:{
		},
		mounted(){
			console.log("asdasd");
			console.log(ordersConfirmed);
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