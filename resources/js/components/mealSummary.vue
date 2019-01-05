<template>
	<div class="jumbotron">
	    <h2>Summary orders</h2>
		<div class="form-group">
			<table class="table table-striped">
				<thead>
					<tr  v-if="orders.length > 0">
						<th>ID</th>
						<th>Table number</th>
						<th>Name Product</th>
						<th>Price</th>
						<th>Total Price</th>
					</tr>
					<tr v-else>
						<td>Não existem orders da meal selecionada</td>
					</tr>
				</thead>
				<tbody>
					<tr v-if="orders.length > 0" v-for="order in orders" :key ="order.id">
						<td>{{order.it_id}}</td>
						<td>{{table}}</td>
						
						<td>{{price}}</td>
					</tr>   
				</tbody>
			</table>
		</div>
	    <div  class="form-group">
	        <a class="btn btn-light" v-on:click.prevent="cancelEdit()">Cancel</a>
	    </div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
		props: ['orders','table','price'],
		data: function(){
			return { 
				name: null,
				check: 1,
				check1: 1,
				item: null,
				id: null,
			}
		},
	    methods: {
	        getName: function(order){
                axios.get('api/orderItem/'+order.item_id)
					.then(response=>{this.item = response.data.data});
					console.log(this.item);
					
			},
			getPrice: function(order){
                axios.get('api/orderItem/'+order.item_id)
					.then(response=>{this.item = response.data.data; });
            },
		}
	}
</script>

<style scoped>	
.label{
	color: red,
}
.img-circle {
	border-radius: 50%;
	display: block;
	margin-left: auto;
	margin-right: auto;
}
.label-center {
	display: block;
    text-align: center;
    line-height: 150%;
	margin-left: auto;
	margin-right: auto;
}
.read-only {
	background-color:#ccfafc;
}
</style>