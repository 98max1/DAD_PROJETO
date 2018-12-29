<template>
	<div class="jumbotron">
	    <h2>Edit User</h2>
	    <div class="form-group">
	        <label class="label-center">Profile Picture (click on the picture to select a new one)</label>
	        <input style="display:none" type="file" @change="onFileSelected" ref="fileInput"> 
	        <img @click="$refs.fileInput.click()"type="img" class="img-circle" name="photo" placeholder="IMG" :src="'storage/profiles/'+user.photo_url" >

	        <button class="btn btn-primary label-center" @click="onUpload">Upload</button>
	    </div>
	    <div class="form-group">
	        <label>Id</label>
	        <label type="text" class="form-control read-only" name="id" placeholder="Id"> {{user.id}}</label>
	    </div>
	    <div class="form-group">
	        <label for="inputName">Name</label>
	        <input
	            type="text" class="form-control" v-model="user.name"
	            name="name" id="inputName" 
	            placeholder="Fullname"/>
	    </div>
	    <div class="form-group">
	        <label for="inputUsername">Username</label>
	        <input
	            type="text" class="form-control" v-model="user.username"
	            name="userName" id="inputUsername" 
	            placeholder="Username"/>
	    </div>
	    <div class="form-group">
	        <label for="inputEmail">Email</label>
	        <input
	            type="email" class="form-control" v-model="user.email"
	            name="email" id="inputEmail"
	            placeholder="Email address"/>
	    </div>
	    <div class="form-group">
	        <label for="inputType">Type</label>
	        <select class="form-control" v-model="user.type">
				  <option value="manager">Manager</option>
				  <option value="cook">Cook</option>
				  <option value="waiter">Waiter</option>
				  <option value="cashier">Cashier</option>
			</select>
	    </div>
	    <div class="form-group">
	        <label for="inputType">Blocked</label>
	        <select class="form-control" v-model="user.blocked">
				  <option value="1">Block</option>
				  <option value="0">Free</option>
			</select>
	    </div>
	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="saveUser()">Save</a>
	        <a class="btn btn-light" v-on:click.prevent="cancelEdit()">Cancel</a>
	    </div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
		props: ['user'],
		data: function(){
			return { 
				userData:{
					name:"",
					username:"",
					email:"",
					type:"",
					blocked:""
				},
				userAux:"",
				selectedFile:"null",
			}
		},
	    methods: {
	        saveUser: function(){
	        	this.validateFieldsToSend();
	            axios.put('api/users/'+this.user.id, this.userData)
	                .then(response=>{
	                	Object.assign(this.user,response.data);
	                	this.$emit('user-saved', this.user);
	                })
	                .catch(error=>{
	                	this.$emit('user-canceled', this.user);
	                	this.resetFields();
	                });
	        },
	        cancelEdit: function(){
	        	axios.get('api/users/'+this.user.id)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
	                	// without creating a new reference
	                	Object.assign(this.user, response.data);
	                	this.$emit('user-canceled', this.user);
	                	this.resetFields();
	                });
	        },
	        onFileSelected(event){
	        	this.selectedFile=event.target.files[0];
	        },
	        onUpload(){
	        	const fd = new FormData();
	        	fd.append('image',this.selectedFile,this.selectedFile.name);
	        	axios.post('api/upload/'+this.user.id,fd)
	        	.then(response=>{
	        		Object.assign(this.user,response.data);
                	this.$emit('user-saved', this.user);
	        	}).catch(error=>{
	        		console.log(error);
	        	})
	        },
	        validateFieldsToSend(){
	        	if(this.user.name==this.userAux.name){
		        	////console.log("Sao iguais");
	        		this.userData.name=null;
	        	}else{this.userData.name=this.user.name;}
	        	
	        	if(this.user.username==this.userAux.username){
	        		this.userData.username=null;
		        }else{this.userData.username=this.user.username;}
	        	
	        	if(this.user.email==this.userAux.email){
	        		this.userData.email=null;
		        }else{this.userData.email=this.user.email;}

	        	if(this.user.type==this.userAux.type){
	        		this.userData.type=null;
		        }else{this.userData.type=this.user.type;}

	        	if(this.user.blocked==this.userAux.blocked){
	        		this.userData.blocked=null;
		        }else{this.userData.blocked=this.user.blocked;}
	        },
	        resetFields(){
	        	this.userData.name=null;
	        	this.userData.username=null;
	        	this.userData.email=null;
	        	this.userData.type=null;
	        	this.userData.blocked=null;
	        	this.userData.photo_url=null;
	        	Object.assign(this.userAux,this.user);
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