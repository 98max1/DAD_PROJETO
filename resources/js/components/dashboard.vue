<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
    	<div class="content">
        	<div class="panel">
	        	<template>
					<select v-model="check" @click="getCheck(check)" class="btn-primary">
			            <option value="invoices">Check Invoices</option>
			            <option value="meals">Check Meals</option>
			            <option value="orders">Check Orders</option>
			        </select>
			        	<div v-if="check=='meals'">
							<b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsMeals"
							:items="meals"  :current-page="currentPage" 
							:perPage="perPage"/>
							<b-pagination name="pagination" size="md" :total-rows="meals.length" v-model="currentPage" :per-page="perPage"/>
			        	</div>
			        	<div v-else-if="check=='orders'">
							<b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsOrders"
							:items="orders"  :current-page="currentPage" 
							:perPage="perPage"/>
							<b-pagination name="pagination" size="md" :total-rows="orders.length" v-model="currentPage" :per-page="perPage"/>
			        	</div>
			        	<div v-else>
							<b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsInvoices"
							:items="invoices"  :current-page="currentPage" 
							:perPage="perPage"/>
							<b-pagination name="pagination" size="md" :total-rows="invoices.length" v-model="currentPage" :per-page="perPage"/>
			        	</div>
							
   				 </template>
        	</div>
        </div>
        <div>

			<!--
        	<la-cartesian :width="275" :height="40" :data="values">
        		<la-area animated prop="value" >
        			
        		</la-area>	
    		</la-cartesian>	-->
        </div>

    </div>              
</template>

<script type="text/javascript">
    //import {Cartesian,Area} from 'laue';
    //import { GChart } from 'vue-google-charts';
    export default {
        data: function(){
            return { 
                title: 'Dashboard',
                pagination:[],
                fieldsMeals:[
                	{key :'id',sortable:true},
                	{key :'state',sortable:true},
                	{key :'item_id',sortable:true},
                	{key :'meal_id',sortable:true},
                	{key :'start',sortable:true},
                	{key :'end',sortable:true},
                	{key :'responsible_cook_id',sortable:true},
                	{key :'total_price_preview',sortable:true}
            		],
                fieldsOrders:[
                	{key :'id',sortable:true},
                	{key :'state',sortable:true},
                	{key :'table_number',sortable:true},
                	{key :'start',sortable:true},
                	{key :'end',sortable:true},
                	{key :'responsible_waiter_id',sortable:true},
                	{key :'total_price_preview',sortable:true}
            		],
                fieldsInvoices:[
                	{key :'id',sortable:true},
                	{key :'state',sortable:true},
                	{key :'meal_id',sortable:true},
                	{key :'nif',sortable:true},
                	{key :'name',sortable:true},
                	{key :'date',sortable:true},
                	{key :'total_price',sortable:true},
            		],
            	sortBy:"id",
            	sortDesc:false,
                urlInvoices:'/api/invoicesInfo',
                urlMeals:'/api/mealsInfo',
                urlOrders:'/api/ordersInfo',
                check:"meals",
                invoices:[],
                meals:[],
                orders:[],
                currentPage:1,
                perPage:5,
                /*chartOptions: {
			        chart: {
						title: 'Company Performance',
						subtitle: 'Sales, Expenses, and Profit: 2014-2017',
			        }
				}*/
            }
        },
        methods: {
           getInvoices(){
           	let $this=this;
                axios.get(this.urlInvoices)
                    .then(response=>{
                        this.invoices = response.data.data; 
                        //$this.makePagination(response.data);
                    });
           },
           getMeals(){
           	let $this=this;
                axios.get(this.urlMeals)
                    .then(response=>{
                        this.meals = response.data.data; 
                        //$this.makePagination(response.data);
                    });
           },
           getOrders(){
           	let $this=this;
                axios.get(this.urlOrders)
                    .then(response=>{
                        this.orders = response.data.data; 
                        //this.makePagination(response.data);
                    });
           },
            makePagination(data){
                let pagination={
                    currentPage: data.meta.current_page,
                    last_page: data.meta.last_page,
                    next_page_url: data.links.next,
                    prev_page_url: data.links.prev
                }
                this.pagination=pagination;
            },
            getCheck(toCheck){
            	if(toCheck=='invoices')
            		this.getInvoices(this.urlInvoices);
            	if(toCheck=='meals')
            		this.getMeals(this.urlMeals);
            	if(toCheck=='orders')
            		this.getOrders(this.urlOrders);
            }
        },
        components: {
           // LaCartesian :Cartesian,
            //LaArea:Area,
            //gChart:GChart
        },
        mounted() {
        //	this.getMeals();
        }

    }
</script>

<style scoped>  
p {
    font-size: 2em;
    text-align: center;
}
</style>