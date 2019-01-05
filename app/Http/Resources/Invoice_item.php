<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
        
        <user-list :users="users" @edit-click="editUser" @delete-click="deleteUser" @message="childMessage" ref="usersListRef"></user-list>
        <div class="pagination" >             
            <button class="btn btn-default" v-on:click="fetchPaginateUsers(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Prevous</button>
            <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
            <button class="btn btn-default" v-on:click="fetchPaginateUsers(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
        </div>
        <user-edit v-show ="this.$store.state.user.type=='manager'" :user="currentUser" @user-saved="savedUser" @user-canceled="cancelEdit" v-if="currentUser"></user-edit>

        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>

    </div>              
</template>

<script type="text/javascript">
    import UserList from './userList.vue';
    import UserEdit from './userEdit.vue';
    
    export default {
        data: function(){
            return { 
                title: 'List Users',
                showSuccess: false,
                successMessage: '',
                currentUser: null,
                users: [],
                pagination:[],
                url:'/api/users'
            }
        },
        methods: {
            editUser: function(user){
                this.currentUser = user;
                this.showSuccess = false;
                console.log("++"+this.$store.state.user.type);
            },
            deleteUser: function(user){
                this.currentUser=user;
                axios.delete('api/users/'+this.currentUser.id)
                    .then(response => {
                        this.showSuccess = true;
                        this.successMessage = 'User Deleted';
                        this.getUsers();
                    }).catch(error=>{
                        console.log(error);
                    })
                    this.currentUser=null;
            },
            savedUser: function(){
                this.currentUser = null;
                this.$refs.usersListRef.editingUser = null;
                this.showSuccess = true;
                this.successMessage = 'User Saved';
            },
            cancelEdit: function(){
                this.currentUser = null;
                this.$refs.usersListRef.editingUser = null;
                this.showSuccess = false;
            },
            getUsers: function(){
                let $this=this;
                axios.get(this.url)
                    .then(response=>{
                        this.users = response.data.data; 
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
            fetchPaginateUsers(url){
                this.url=url;
                this.getUsers();
            }
        },
        components: {
            'user-list': UserList,
            'user-edit': UserEdit
        },
        mounted() {
            this.getUsers();
        }

<<<<<<< HEAD
class Invoice_item extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'invoice_id' => $this->invoice_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'sub_total_price' => $this->sub_total_price,
        ];
=======
>>>>>>> ff652929109bc387b9eed5d38a0c2a27d363ddd1
    }
</script>

<style scoped>  
p {
    font-size: 2em;
    text-align: center;
}
</style>