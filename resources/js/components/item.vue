<template>
	<div>
		<div class="jumbotron">
			<h1>{{title}}</h1>
		</div>

		<item-list :items="items" @edit-click="editItem" @delete-click="deleteItem" @message="childMessage" ref="itemsListRef"></item-list>
		<div class="pagination" >             
            <button class="btn btn-default" v-on:click="fetchPaginateItems(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Prevous</button>
            <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
            <button class="btn btn-default" v-on:click="fetchPaginateItems(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
        </div>
		<item-edit v-show ="this.$store.state.user.type=='manager'" :item="currentItem" @item-saved="savedItem" @item-canceled="cancelEdit" v-if="currentItem"></item-edit>
        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
	</div>
</template>

<script type="text/javascript">
	import ItemList from './itemList.vue';
	import ItemEdit from './itemEdit.vue';
	export default {
		data: function(){
			return {
				title: 'List items',
				showSuccess: false,
				successMessage : '',
                currentItem: null,
                pagination:[],
				items: [],
                url:'/api/items'
			}
		},

		methods: {
			editItem: function(item){
                this.currentItem = item;
                this.showSuccess = false;
            },
            deleteItem: function(item){
                this.currentItem=item;
                axios.delete('api/item/'+this.currentItem.id)
                    .then(response => {
                        this.showSuccess = true;
                        this.successMessage = 'Item Deleted';
                        this.getItems();
                    }).catch(error=>{
                        console.log(error);
                    })
                    this.currentItem=null;
            },
            savedItem: function(){
                this.currentItem = null;
                this.$refs.itemsListRef.editingItem = null;
                this.showSuccess = true;
                this.successMessage = 'Item Saved';
            },
            cancelEdit: function(){
                this.currentItem = null;
               // this.$refs.itemsListRef.editingItem = null;
                this.showSuccess = false;
            },
            getItems: function(){
                let $this=this;
                axios.get(this.url)
                    .then(response=>{
                        this.items = response.data.data; 
                        $this.makePagination(response.data);
                    });
            },
            childMessage: function(message){
                this.showSuccess = true;
                this.successMessage = message;
            },
            makePagination(data){
                let pagination={
                    current_page: data.meta.current_page,
                    last_page: data.meta.last_page,
                    next_page_url: data.links.next,
                    prev_page_url: data.links.prev
                }
                this.pagination=pagination;
            },
            fetchPaginateItems(url){
                this.url=url;
                this.getItems();
            }
		},
		components: {
			'item-list': ItemList,
			'item-edit': ItemEdit
		},
		mounted(){
			this.getItems();
		}
	}
</script>

<style scoped>
	
</style>