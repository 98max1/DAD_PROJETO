<template>
	<div id="login">
        <h1>Login</h1>
        <input type="text" name="email" v-model="input.email" placeholder="Email" />
        <input type="password" name="password" v-model="input.password" placeholder="Password" />
        <button type="button" v-on:click="loginUser" value="submit">Login</button>
        <p type="text" v-model="success" > {{success}} </p>
        <a type="text" href="/" > Reset Password </a>
	
	</div>
</template>
<script>
	module.exports ={
	data:function(){ 
 		return {
 			input:{
		        email:"",
		        password:""
 			},
 			success:""
	    }
	},

    methods: {
        loginUser: function(){
            axios.post('/api/login',{
            	email:this.input.email,
            	password:this.input.password
            }).then(response=>{
            	if (response.status!=200) {
            		throw error;
            	}else {
            		this.success ="Login Successfull";
            	}
            }).catch(error=>{
        		this.success ="Login Unsuccessfull -> ";
        		this.clearFields();

            }); 
        },
        clearFields: function(){
        	this.input.email="";
        	this.input.password="";
        	this.success= this.success + " Please insert email and password again."
        }
    },

	mounted() {
       
	}
};
</script>

<style>

</style>