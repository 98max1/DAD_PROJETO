<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div> 

        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div> 
        
        <stats-list :users="users" ref="ordersListRef"></stats-list>

        
    </div>              
</template>

<script type="text/javascript">
    import StatsList from './statsList.vue';
    import Vue from 'vue';
    import VueSwal from 'vue-swal';
    
    export default {
        data: function(){
            return { 
                title: 'List Meals',
                showSuccess: false,
                successMessage: '',
                currentUser: null,
                users: [],
                table_order: null,
                currentMeal: null,
                currentMealTerminate: null,
                price_order: null,
            }
            errors:{}
        },
        methods: {
            getUsers: function(){
                axios.get('api/getUsers')
                    .then(response=>{this.users = response.data.data; 
                });
            },
            childMessage: function(message){
                this.showSuccess = true;
                this.successMessage = message;
            }
        },
        components: {
            'stats-list': StatsList,
        },
        mounted() {
            this.getUsers();
        }

    }
</script>

<style scoped>  
p {
    font-size: 2em;
    text-align: center;
}
</style>