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
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="item in items" :key ="item.id" :class="{activerow: editingItem === item}" >
	            <td>{{item.id}}</td>
	            <td>{{item.name}}</td>
	            <td>{{item.type}}</td>
	            <td>{{item.description}}</td>
	            <td><img class="photo" type="img" name="photo" :src="'storage/items/'+item.photo_url "></td>
	            <td>{{item.price}}</td>
	            <td>
	                <button class="btn-primary"  @click.prevent="editItem(item)">EDIT</button>
	                <button class="btn-danger"  v-on:click.prevent="deleteItem(item)">DELETE</button>
	            </td>
	        </tr>   
	    </tbody>
	</table>

</template>

<script>
	module.exports ={
	props:["items"],
		data: function(){
			return{
				editingItem: null
			}
		},
		methods:{
			editItem: function(item){
				this.editingItem=item;			
				this.$emit('edit-click',item);
				this.editingItem=null;
			},
			deleteItem: function(item){
				this.editingItem=null;
				this.$emit('delete-click',item);
				this.editingItem=null;
			},
			status: function(type){
				if(type==0)
					return true ;
				else
					return false;
			},
            toggleOrder(name){
                this.currentOrder=name;
            },
            orderedItems(items){
               return items.sort((a,b) => a.id <b.id ? 1:-1);
            }
		}
	}

</script>

<style>
.photo{
	width: 130px;
	height: 130px; 
}
</style>