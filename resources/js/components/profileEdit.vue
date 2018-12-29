<template>
	<div class="jumbotron">
	    <h2>Edit User</h2>
	    <div class="form-group">
	        <label class="label-center">Profile Picture (click on the picture to select a new one)</label>
	        <input style="display:none" type="file" @change="onFileSelected" ref="fileInput"> 
	        <img @click="$refs.fileInput.click()" type="img" class="img-circle" name="photo" placeholder="IMG" :src="'storage/profiles/'+user.photo_url">
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
	    <div class="form-group" >
	        <label for="inputEmail">Email</label>
	        <input v-if="$store.state.user.type==='manager'"
	            type="email" class="form-control" v-model="user.email"
	            name="email" id="inputEmail"
	            placeholder="Email address"/>
	        <label v-else type="text" class="form-control read-only" name="email" placeholder="Email"> {{user.email}}</label>
	    </div>

	    <div class="form-group">
	        <label>Type</label>
	        <label type="text" class="form-control read-only" name="type" placeholder="Type"> {{user.type}}</label>
	    </div>

	    <div class="form-group">
	        <label>Change Password</label>
	        <form>
	        	
	        <input
	            type="password" class="form-control"
	            name="password" v-model="NewPassword" id="inputNewPassword"
	            placeholder="New Password"/>
	        <input
	            type="password" class="form-control"
	            name="password" v-model="ConfirmPassword" id="inputConfirmPassword"
	            placeholder="Confirm Password"/>
	        </form>
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
					password:""
				},
				NewPassword:"",
				ConfirmPassword:"",
				selectedFile:"null",
				teste1:"",
				teste2:"",
			}
		},
	    methods: {
	        saveUser: function(){
	        	this.validateFieldsToSend();
	        	console.log("waaaaaaaaaaaaaaaat")
	            axios.put('api/users/'+this.user.id, this.userData)
	                .then(response=>{
	                	//console.log("response.....................");
	                	//console.log(response);
	        			this.updateUser(response.data);
	                	this.$emit('user-saved', this.user);
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
	        	console.log("eventoooooo");
	        	console.log(event.target.files);
	        },
	        onUpload(){
	        	const fd = new FormData();
	        	fd.append('image',this.selectedFile,this.selectedFile.name);
	        	axios.post('api/upload/'+this.user.id,fd)
	        	.then(response=>{
	        		this.user=response.data;
	        		this.$store.state.user=response.data;
           		 	this.$store.commit('setUser',response.data);
                	this.$emit('user-saved', this.user);
	        	}).catch(error=>{
	        		console.log(error);
	        	})
	        },
	        checkPassword(){
		        	if(this.NewPassword==this.ConfirmPassword){
		        		this.userData.password=this.ConfirmPassword;
		        		return true;
		        	}else{
		        		return false;
		        	}

	        },
	        validateFieldsToSend(){
		        	////console.log("FILEEEEEEEEE**********---------******");
		        	////console.log(this.selectedFile.name);
		        	////console.log(this.user.name);
	        	if(this.user.name==this.$store.state.user.name){
		        	////console.log("Sao iguais");
	        		this.userData.name=null;
	        	}else{this.userData.name=this.user.name;}
	        	
	        	if(this.user.username==this.$store.state.user.username){
	        		this.userData.username=null;
		        }else{this.userData.username=this.user.username;}
	        	
	        	if(this.user.email==this.$store.state.user.email){
	        		this.userData.email=null;
		        }else{this.userData.email=this.user.email;}
	        	/*//console.log("respostaaaaa!!");
	        	//console.log(this.selectedFile.name);
	        	//console.log(this.$store.state.user.photo_url);
	        	if(this.selectedFile.name==undefined||this.selectedFile.name==this.$store.state.user.photo_url){
	        		this.userData.photo_url=null;
		        }else{
	        		console.log("validateeeeee");
		        	//this.userData.photo_url=this.onUpload();
		        	//this.onUpload();
		        	this.userData.photo_url = new FormData();
	        		this.userData.photo_url.append('image',this.selectedFile,this.selectedFile.name);
	        		//this.userData.photo_url=fd
		        }
	        	*/
	        	if(this.NewPassword!=null&&this.ConfirmPassword!=null){
					if(this.checkPassword()){
			        	this.userData.password=this.ConfirmPassword;
					}else{
			        	this.userData.password=null;
					}
	        	}
	        },
	        resetFields(){
	        	this.userData.name=null;
	        	this.userData.username=null;
	        	this.userData.email=null;
	        	this.userData.photo_url=null;
	        },
	        updateUser(response){
	        	this.user=response;
	        	/*//console.log("respostaaaaa");
	        	//console.log(response.photo_url);*/
            	//Object.assign(this.user, response);
	        	this.$store.state.user=response;
                this.$store.commit('setUser',response);
	        },
	        teste(){
	        	////console.log("teste----------------");
	        	teste2="sou teste2";
	        	////console.log("teste----------------");
	        	teste1=teste2;
	        	////console.log("teste----------------");
	        	////console.log(teste1);
	        	teste1="sou teste1";
	        	////console.log(teste1);
	        	////console.log(teste2);
	        	this.validateFieldsToSend();
	        },
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