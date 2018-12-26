<template>
	<div class="jumbotron">
	    <h2>Edit User</h2>
	    <div class="form-group">
	        <label class="label-center">Profile Picture (click on the picture to select a new one)</label>
	        <input style="display:none" type="file" @change="onFileSelected" ref="fileInput"> 
	        <img @click="$refs.fileInput.click()" type="img" class="img-circle" name="photo" placeholder="IMG" :src="'storage/profiles/' + user.photo_url" >
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
	        <label>Type</label>
	        <label type="text" class="form-control read-only" name="type" placeholder="Type"> {{user.type}}</label>
	    </div>

	    <div class="form-group">
	        <label>Change Password</label>
	        <input
	            type="password" class="form-control"
	            name="password" v-model="NewPassword" id="inputNewPassword"
	            placeholder="New Password"/>
	        <input
	            type="password" class="form-control"
	            name="password" v-model="ConfirmPassword" id="inputConfirmPassword"
	            placeholder="Confirm Password"/>
	    </div>
	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="saveUser()">Save</a>
	        <a class="btn btn-primary" v-on:click.prevent="teste()">teste</a>
	        <a class="btn btn-light" v-on:click.prevent="cancelEdit()">Cancel</a>
	    </div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
		props: ['user'],
		data: function(){
			return { 
			   NewPassword:"",
			   ConfirmPassword:"",
			   selectedFile:"null",
			}
		},
	    methods: {
	        saveUser: function(){
	        	this.checkPassword();
	            axios.put('api/users/'+this.user.id, this.user)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
	                	// without creating a new reference
	                	Object.assign(this.user, response.data.data);
	                	this.$emit('user-saved', this.user)
	                });
	        },
	        cancelEdit: function(){
	        	axios.get('api/users/'+this.user.id)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
	                	// without creating a new reference
	                	Object.assign(this.user, response.data.data);
	                	this.$emit('user-canceled', this.user);
	                });
	        },
	        onFileSelected(event){
	        	this.selectedFile=event.target.files[0];
	        	console.log(event);
	        },
	        onUpload(){
	        	const fd = new FormData();
	        	fd.append('image',this.selectedFile,this.selectedFile.name);
        		//console.log(this.selectedFile.name);
	        	axios.post('api/upload/'+this.user.id,fd)
	        	.then(response=>{
	        		this.user.photo_url=response.data;
	        		this.$store.state.user.photo_url=this.user.photo_url;
	        		//console.log(this.$store.state.user.photo_url);
                	this.$emit('user-saved', this.user);
	        	}).catch(error=>{
	        		console.log(error);
	        	})
	        },
	        checkPassword(){
	        	if(this.NewPassword!=null&&this.ConfirmPassword!=null){
		        	if(this.NewPassword==this.ConfirmPassword){
		        		this.user.password=this.ConfirmPassword;
		        		console.log("passwords  match");
		        		return true;
		        	}else{
		        		console.log("passwords do not match");
			        	return false;
		        	}
	        	}
	        },
	        validateFieldsToSend(){
	        	console.log("name"+this.user.name);
	        	console.log("name"+this.$store.state.user.name);
	        	if(this.user.name!=this.$store.state.user.name){
	        		console.log("name"+this.user.name!=this.$store.state.user.name);
		        }
	        	if(this.user.username!=this.$store.state.user.username){
	        		console.log("username"+this.user.username!=this.$store.state.user.username);
		        }
	        	if(this.user.email!=this.$store.state.user.email){
	        		console.log("email"+this.user.email!=this.$store.state.user.email);
		        }
	        	if(this.NewPassword!=null&&this.ConfirmPassword!=null){
	        		if(this.checkPassword()){

	        		}
		        }
	        },
	        teste(){
	        	console.log("teste");
	        	console.log(this.userData.name.value);
	        	this.validateFieldsToSend();
	        },
	        teste2(teste){
	        	console.log(this.inputNewPassword==null);
	        }
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