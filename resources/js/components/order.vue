<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>  

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <router-link to="/orderCreate" tag="button" class="btn btn-outline-secondary">Create order</router-link>

            </div>
        </div>

        <order-list :ordersWaiter="ordersWaiter" @message="childMessage" ref="ordersListRef"></order-list>

        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
    </div>              
</template>

<script type="text/javascript">
    import OrderList from './orderList.vue';
    
    export default {
        data: function(){
            return { 
                title: 'List Orders',
                showSuccess: false,
                successMessage: '',
                currentUser: null,
                ordersWaiter: [],
                errors:{},
            }
            errors:{}
        },
        methods: {
            getOrdersWaiter: function(){
                axios.get('api/ordersWaiter')
                    .then(response=>{this.ordersWaiter = response.data.data; });
            },
            childMessage: function(message){
                this.showSuccess = true;
                this.successMessage = message;
            },
        },
        components: {
            'order-list': OrderList,
        },
        mounted() {
            this.getOrdersWaiter();
        }

    }
</script>

<style scoped>  
p {
    font-size: 2em;
    text-align: center;
}
</style>