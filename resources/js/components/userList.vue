<template>
	<table class="table table-striped">
		<select v-model="currentOrder" @click="orderedItems" >
            <option value="id"> Sort by Id</option>
            <option value="name">Sort by name</option>
            <option value="username">Sort by username</option>
            <option value="type">Sort by type</option>
            <option value="blocked">Sort by status</option>
        </select>
    	<thead>
	        <tr>
	            <th>ID</th>
	            <th>Name</th>
	            <th>Username</th>
	            <th>Email</th>
	            <th>Type</th>
	            <th>Blocked</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="user in users" :key ="user.id" :class="{activerow: editingUser === user}">
	            <td>{{user.id}}</td>
	            <td>{{user.name}}</td>
	            <td>{{user.username}}</td>
	            <td>{{user.email}}</td>
	            <td>{{user.type}}</td>
	            <td v-if="status(user.blocked)">Free</td>
	            <td v-else>Blocked</td>
	            <td>
	                <button class="btn-primary"  @click.prevent="editUser(user)">EDIT</button>
	                <button class="btn-danger" v-show="$store.state.user.id != user.id" v-on:click.prevent="deleteUser(user)">DELETE</button>
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
				currentOrder:"",
				editingUser: null
			}
		},
		methods:{
			editUser: function(user){
				if(user.id==this.$store.state.user.id){
                    this.$router.push('/profile');
				}
				this.editingUser=user;			
				this.$emit('edit-click',user);
				this.editingUser=null;
			},
			deleteUser: function(user){
				this.editingUser=null;
				this.$emit('delete-click',user);
				this.editingUser=null;
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
            orderedItems(users){
               return users.sort((a,b) => a.id <b.id ? 1:-1);
            }
		}
	}

</script>

<style>

</style>