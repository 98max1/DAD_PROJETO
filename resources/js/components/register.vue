
<template v-if="isLoggedIn">
	<div id="register">
        <h1>Register Worker</h1>
        <p>
        	NAME
        	<input type="text" name="name" v-model="name" placeholder="Name" />
        </p>
        <p>
        	USERNAME
        	<input type="text" name="username" v-model="username" placeholder="Username" />
        </p>
        <p>
        	EMAIL
        	<input type="text" name="email" v-model="email" placeholder="Email" />
        </p>
        <p>
        	PASSWORD
        	<input type="password" name="password" v-model="password" placeholder="Password" />
        </p>
        <p>
        	TYPE
        	<input type="text" name="type" v-model="type" placeholder="type" />
        </p>
        <p>
        	BLOCKED STATUS
        	<input type="text" name="blocked" v-model="blocked" placeholder="blocked" />
        </p>
        <p>
        	PHOTO
        	<input type="text" name="photo" v-model="photo_url" placeholder="Photo" />
        </p>
        <button type="button" v-on:click="register" value="submit">Submit</button>
	</div>
</template>
<script>
	module.exports ={
			data:function(){ 
		 		return {
			        name:"",
			        username:"",
			        email:"",
			        password:"",
			        type:"",
			        blocked:"",
		 			success:""
			    }
			},
		    methods: {
		        register: function(){
		            axios.post('/api/register',{

		            	name:this.name,
		            	username:this.username,
		            	email:this.email,
		            	password:this.password,
		            	type:this.type,
		            	blocked:this.blocked
		            }).then(response=>{		            	

	            		//console.log(response);
		            }).catch(error=>{
	            		//console.log(error);
		            }); 
		        },
		    },
			mounted() {
		       
			}
};
</script>

<style>

</style>