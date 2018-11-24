<template>
	<div>
		<p align="center">
			Register Worker
			<p>
				Insert Name:
				<input v-model="currentWorker.name" placeholder="Name">
				<p>Registering user: {{ currentWorker.name}}</p>
			</p>
		</p>

	</div>
</template>

<!--	
	<table class="table table-striped">
    	<thead>
	        <tr>
	            <th>Register Worker</th>
	            <th>Email</th>
	            <th>Age</th>
	            <th>Department</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="(user,index) in users" :key ="user.id">
	            <td>{{user.name}}</td>
	            <td>{{user.email}}</td>
	            <td>{{user.age}}</td>
	            <td>{{user.department}}</td>
	            <td>
	                <button @click.prevent="editUser(user)">EDIT</button>
	                <button v-on:click.prevent="deleteUser(user,index)">DELETE</button>
	            </td>
	        </tr>   
	    </tbody>
	</table>

</template>

<script>
	module.exports ={
	props:["users"],
		data: function(){
			return{

			}
		},
		methods:{
			editUser: function(user,index){
				this.$emit('edit-user',user,index);
			},
			deleteUser: function(user,index){
				this.$emit('delete-user',user,index);

			}	
		} 
	}
</script>
-->
<script>
	module.exports ={
	data:function(){ 
 		return {
	        editingUser: false,   
	        message: '',
	        currentWorker: {},
	        users: []
	    }
	},
    methods: {
        editUser: function(user){
            this.editingWorker=true;
            this.currentWorker=Object.assign({},user);
        },
        saveUser: function(){
            const user = this.currentWorker;
            axios.put('/api/users/'+user.id,user)
            .then(response=>{
                this.users.forEach(u =>{
                    if (u.id==user.id) {
                        Object.assign(u,response.data.data);

                    }   
                })
                this.editingWorker=false;
            }).catch(error=>{
            }) 
        },
        cancelEdit: function(){
            this.editingWorker=false;
        }
    },
	mounted() {
       
	}
};
</script>

<style>

</style>