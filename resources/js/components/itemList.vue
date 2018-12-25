<template>
	<table class="table table-striped">
    	<thead>
	        <tr>
	            <th>ID</th>
	            <th>Name</th>
	            <th>Type</th>
	            <th>Description</th>
	            <th>Photo</th>
	            <th>Price</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="item in items" :key ="item.id" >
	            <td>{{item.id}}</td>
	            <td>{{item.name}}</td>
	            <td>{{item.type}}</td>
	            <td>{{item.description}}</td>
	            <td><img type="img" name="photo" :src="'storage/app/public/profiles/'+ item.photo_url "></td>
	            <td>{{item.price}}</td>
	        </tr>   
	    </tbody>
	</table>

</template>

<script>
	module.exports ={
	props:["items"],
		data: function(){
			
		},
		methods:{
		}
	}

</script>

<style>

</style>