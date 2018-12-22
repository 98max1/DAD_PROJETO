<template>
	<table class="table table-striped" v-if="user.shift_active === 1">		
		<caption>Yor are currently in a shift</caption>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Username</th>
			<th>Shift Start</th>
			<th>Time passed</th>
			<th>Action</th>
		</tr>
		<tr>
			<td>{{user.id}}</td>
			<td>{{user.name}}</td>
			<td>{{user.username}}</td>
			<td>{{user.last_shift_start}}</td>
			<td><CountdownTimer :date="(user.last_shift_start)"></CountdownTimer></td>
			<td>
				<div class="form-group">
					<a id="buttonLeave" class="btn btn-danger" v-on:click.prevent="endShift()">End</a>
				</div>
			</td>
		</tr> 
	</table>

	<table class="table table-striped" v-else>
    	<caption>Yor are not in a shift</caption>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Username</th>
			<th>Last Shift End</th>
			<th>Time passed</th>
			<th>Action</th>
		</tr>
		<tr>
			<td>{{user.id}}</td>
			<td>{{user.name}}</td>
			<td>{{user.username}}</td>
			<td>{{user.last_shift_end}}</td>
			<td><CountdownTimer :date="(user.last_shift_end)"></CountdownTimer></td>
			<td>
				<div class="form-group">
					<a id="buttonStart" class="btn btn-success" v-on:click.prevent="startShift()">Start new Shift</a>
				</div>
			</td>
		</tr> 
	</table>

</template>
<script type="text/javascript">
	import CountdownTimer from './Timer.vue';
	import axios from 'axios';
	export default{
		props: ['user'],
		components: {
			CountdownTimer,
		},
	    methods: {
	        endShift: function(){
	            axios.put('api/users/'+this.user.id, this.user)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
						// without creating a new reference
						this.user.last_shift_end = this.datenow = moment().format();
						console.log(this.datenow = moment().format());
	                	//Object.assign(this.user, response.data.data);
	                	//this.$emit('user-saved', this.user)
	                });
	        }
		}
	}


</script>

<style scoped>	
.label{
	color: red,
}
h2 { 
  text-align: center;
}
.btn-danger .btn{
	text-align: center;
}
#buttonLeave{
	color: white !important;
}



caption {
    caption-side: top;
	align-content: center;
	align-items: center;
	text-align: center;
	font-size: 30px;
}

</style>