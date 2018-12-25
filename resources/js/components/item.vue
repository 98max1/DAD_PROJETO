<template>
	<div>
		<div class="jumbotron">
			<h1>{{title}}</h1>
		</div>

		<item-list :items="items" ref="itemsListRef"></item-list>
	</div>
</template>

<script type="text/javascript">
	import ItemList from './itemList.vue';

	export default {
		data: function(){
			return {
				title: 'List items',
				showSuccess: false,
				successMessage : '',
				items: [],
			}
		},

		methods: {
			getItems: function(){
                axios.get('api/items')
                    .then(response=>{this.items = response.data.data; });
            },

			childMessage: function(message){
				this.showSuccess = true;
				this.successMessage = message;
			}
		},
		components: {
			'item-list': ItemList
		},
		mounted(){
			this.getItems();
		}
	}
</script>

<style scoped>
	
</style>