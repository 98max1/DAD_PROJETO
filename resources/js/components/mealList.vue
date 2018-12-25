<template>
	<table class="table table-striped">
    	<thead>
	        <tr>
	            <th>ID</th>
	            <th>State</th>
	            <th>Table number</th>
	            <th>Start</th>
	            <th>End</th>
	            <th>Responsible Waiter</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="meal in meals" :key ="meal.id">
	            <td>{{meal.id}}</td>
	            <td>{{meal.state}}</td>
	            <td>{{meal.table_number}}</td>
	            <td>{{meal.start}}</td>
	            <td>{{meal.end}}</td>
	            <td>{{meal.responsible_waiter_id}}</td>
				<td>{{meal.total_price_preview}}</td>
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
		}
	}

</script>

<style>

</style>