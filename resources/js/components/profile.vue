<template>
    <div>
        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
        <profile-edit :user="profileUser" @user-saved="savedUser" @user-canceled="cancelEdit"></profile-edit>
    </div>              
</template>

<script type="text/javascript">    
   // import userEdit from './userEdit.vue';
    import profileEdit from './profileEdit.vue';

    export default {
        data: function(){
            return { 
                profileUser: {
                    email:"",
                    id:"",
                    name:"",
                    type:"",
                },
                successMessage: "",
                showSuccess: false
            }
        },
        methods: {
            getInformationFromLoggedUser() {
                Object.assign(this.profileUser , this.$store.state.user);
                //console.log("profileUser");
                //console.log(this.profileUser.photo_url);
                //console.log("profileUseraaaaaaaaaaa");
                //console.log(this.$store.state.user.photo_url);
            },
            savedUser: function(){
                this.showSuccess = true;
                this.successMessage = "User's Profile Updated";
                this.getInformationFromLoggedUser();
            },
            cancelEdit: function(){
                this.showSuccess = false;
            },            
        },
        mounted() {
            //console.log("---"+this.$store.state.user.photo_url);
            this.getInformationFromLoggedUser();
        },
        components: {
            'profile-edit':profileEdit, 
        }  
    }
</script>