<template>
    <div>
        <div class="alert" :class="typeofmsg" v-if="showMessage">             
            <button type="button" class="close-btn" v-on:click="showMessage=false">&times;</button>
            <strong>{{ message }}</strong>
        </div>
        <div class="jumbotron">
            <h2>Reset Password</h2>
            <div class="form-group">
                <label for="inputPassword">New Password</label>
                <input
                    type="password" class="form-control" v-model="conf1Password"
                    name="password" id="inputEmail"/>
            </div>
            <div class="form-group">
                <label for="inputRepeatPassword">Confirm Password</label>
                <input
                    type="password" class="form-control" v-model="conf2Password"
                    name="repeatPassword" id="inputRepeatPassword"/>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" v-on:click.prevent="reset">Confirm</a>
                <router-link class="btn btn-danger" to="/login">Cancel</router-link>
            </div>  
        </div>
    </div>
</template>

<script>
	module.exports ={
			data:function(){ 
		 		return {
                    user: {
                        token:"",
                        email:"",
                        password:"",
                        password_confirmation:""
                    },
                    conf1Password:"",
                    conf2Password:"", 
                    typeofmsg: "alert-success",
                    showMessage: false,
                    message: "",
            }
        },
        methods: {
            reset() {
                this.showMessage = false;
                console.log("asdaads");
                if(this.conf1Password==this.conf2Password){

                    this.user.token=this.$route.params.token;
                    this.user.email=this.$route.params.email;
                    this.user.password=this.conf1Password;
                    this.user.password_confirmation=this.conf2Password;
                    axios.post('api/resetPassword',this.user)
                        .then(response => {
                            this.typeofmsg = "alert-success";
                            this.message = "Password successfully reset!";
                            this.showMessage = true;
                        })
                        .catch(error => {
                            this.typeofmsg = "alert-danger";
                            this.message = "Error reseting password!";
                            this.showMessage = true;
                            console.log(error);
                        })
                    }else{
                        this.typeofmsg = "alert-danger";
                        this.message = "Passwords do not Match";
                        this.showMessage = true;
                    }
            }
        },
    }
</script>

<style>

</style>