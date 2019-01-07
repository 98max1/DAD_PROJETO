<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
        <div class="content">
            <div class="panel">
                <template>
                        <div v-if="showOrder==true">
                            <b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsOrders"
                            :items="orders"  :current-page="currentPage" :perPage="perPage">
                                <template slot="show" slot-scope="row">
                                      <b-button size="sm" @click.stop="prepared(row.item)" variant='danger'>
                                      Prepared
                                      </b-button>
                                      <b-button size="sm" @click.stop="prepared(row.item)" variant='danger'>
                                      In preparation
                                      </b-button>
                                </template>
                            </b-table>
                                 
                            <b-pagination name="pagination" size="md" :total-rows="orders.length" v-model="currentPage" :per-page="perPage"/>
                        </div>

                 </template>
            </div>
        </div>
    </div>              
</template>

<script type="text/javascript">
    export default {
        data: function(){
            return { 
                title: 'My Orders',
                pagination:[],
                fieldsOrders:[
                	{key :'id',sortable:true},
                	{key :'state',sortable:true},
                	{key :'item_id',sortable:true},
                	{key :'meal_id',sortable:true},
                	{key :'start',sortable:true},
                	{key :'end',sortable:true},
                	{key :'responsible_cook_id',sortable:true},
                	{key :'total_price_preview',sortable:true},
            		],
            	sortBy:"id",
            	sortDesc:false,
                urlOrders:'/api/myOrders',
                orders:[],
                currentPage:1,
                perPage:5,
                showOrder:true,
            }
        },
        methods: {
           getOrders(){
            let $this=this;
                axios.get(this.urlOrders,this.$store.state.user)
                    .then(response=>{
                        this.orders = response.data.data; 
                    }).catch(error=>{console.log(error)});
           },
           prepared: function(order){   
                axios.patch('api/prepared/'+order.id, order)
                    .then(response=>{
                        Object.assign(order, response.data);
                        this.$emit('order-Prepared',order);
                    });
            },
            inPreparation: function(order){ 
                axios.patch('api/inPreparation/'+order.id, order)
                    .then(response=>{
                        Object.assign(order-InPreparation, response.data);
                        this.$emit('order-',order);
                    });
            },
        },
        mounted() {
            this.getOrders();
        }

    }
</script>

<style scoped>  
p {
    font-size: 2em;
    text-align: center;
}
</style>