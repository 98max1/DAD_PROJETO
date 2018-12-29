<template>
	<div class="jumbotron">
	    <h2>Edit Item</h2>
	    <div class="form-group">
	        <label class="label-center">Item Picture (click on the picture to select a new one)</label>
	        <input style="display:none" type="file" @change="onFileSelected" ref="fileInput"> 
	        <img @click="$refs.fileInput.click()"type="img" class="img-circle" name="photo" placeholder="IMG" :src="'storage/items/'+item.photo_url" >
	        <button class="btn btn-primary label-center" @click="onUpload">Upload</button>
	    </div>
	    <div class="form-group">
	        <label>Id</label>
	        <label type="text" class="form-control read-only" name="id" placeholder="Id"> {{item.id}}</label>
	    </div>
	    <div class="form-group">
	        <label for="inputName">Name</label>
	        <input
	            type="text" class="form-control" v-model="item.name"
	            name="name" id="inputName" 
	            placeholder="Fullname"/>
	    </div>
	    <div class="form-group">
	        <label for="inputDescription">Description</label>
	        <textarea
	            type="text" class="form-control" v-model="item.description"
	            name="description" id="inputDescription" 
	            placeholder="Description"/>
	        	
	    </div>
	    <div class="form-group">
	        <label for="inputType">Type</label>
	        <select class="form-control" v-model="item.type">
				  <option value="dish">Dish</option>
				  <option value="drink">Drink</option>
			</select>
	    </div>
	    <div class="form-group">
	        <label for="inputPrice">Price</label>
	        <input
	            type="number" step="0.01" class="form-control" v-model="item.price"
	            name="price" id="inputPrice" 
	            placeholder="Price"/>
	    </div>
	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="saveItem()">Save</a>
	        <a class="btn btn-light" v-on:click.prevent="cancelEdit()">Cancel</a>
	    </div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
		props: ['item'],
		data: function(){
			return { 
				itemData:{
					name:"",
					type:"",
					description:"",
					price:""
				},
				userAux:"",
				selectedFile:"null",
			}
		},
	    methods: {
	        saveItem: function(){
	        	this.validateFieldsToSend();
	            axios.put('api/items/'+this.item.id, this.itemData)
	                .then(response=>{
	                	Object.assign(this.item,response.data);
	                	this.$emit('item-saved', this.item);
	                })
	                .catch(error=>{
	                	this.$emit('item-canceled', this.item);
	                	this.resetFields();
	                });
	        },
	        cancelEdit: function(){
	        	axios.get('api/items/'+this.item.id)
	                .then(response=>{
	                	Object.assign(this.item, response.data);
	                	this.$emit('item-canceled', this.item);
	                	this.resetFields();
	                });
	        },
	        onFileSelected(event){
	        	this.selectedFile=event.target.files[0];
	        },
	        onUpload(){
	        	const fd = new FormData();
	        	fd.append('image',this.selectedFile,this.selectedFile.name);
	        	axios.post('api/upload/'+this.item.id,fd)
	        	.then(response=>{
	        		Object.assign(this.item,response.data);
                	this.$emit('item-saved', this.item);
	        	}).catch(error=>{
	        		console.log(error);
	        	})
	        },
	        validateFieldsToSend(){
	        	if(this.item.name==this.itemData.name){
	        		this.itemData.name=null;
	        	}else{this.itemData.name=this.item.name;}
	        	
	        	if(this.item.description==this.itemData.description){
	        		this.itemData.description=null;
		        }else{this.itemData.description=this.item.description;}
	        	
	        	if(this.item.type==this.itemData.type){
	        		this.itemData.type=null;
		        }else{this.itemData.type=this.item.type;}

	        },
	        resetFields(){
	        	this.itemData.name=null;
	        	this.itemData.description=null;
	        	this.itemData.type=null;
	        	this.itemData.photo_url=null;
	        	Object.assign(this.itemData,this.item);
	        }
		},
        mounted() {
        	this.resetFields();
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
    height: auto; 
    width: auto; 
    max-width: 300px; 
    max-height: 300px;
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