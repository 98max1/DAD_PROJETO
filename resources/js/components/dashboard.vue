<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
    	<div class="content">
        	<div class="panel">
	        	<template>
	        			<b-button size="sd" @click.stop="showMeal=true,showAllMeal=false,showInvoice=false,showOrder=false" variant='primary'> Show Meals</b-button>
	        			<b-button size="sd" @click.stop="getAllMeals(),showAllMeal=true,showMeal=false,showInvoice=false,showOrder=false" variant='primary'> Show All Meals</b-button>
			        	<div v-if="showMeal==true">
							<b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsMeals"
							:items="meals"  :current-page="currentPage" :perPage="perPage">
					      		  <template slot="Actions" slot-scope="row">
								      <b-button size="sm" @click.stop="currentMeal=row.item ,mealNotPaid()" variant='danger'>
								      Not Paid
								      </b-button>
		    	 				  </template>
							      <template slot="show" slot-scope="row">
								      <b-button size="sm" variant='success' @click.stop="showOrder=true,showMeal=false,showInvoice=false,currentMeal=row.item ,getOrders()" class="mr-2">
								      Orders
								      </b-button>
								      <b-button size="sm" @click.stop="showOrder=false,showInvoice=true,showMeal=false,currentMeal=row.item ,getInvoices()" class="mr-2">
								      Invoices
								      </b-button>
								      <b-button size="sm" @click.stop="showOrder=false,showInvoice=true,showMeal=false,currentMeal=row.item ,getInvoicesAll()" class="mr-2">
								      All Invoices
								      </b-button>
								     </template>
							</b-table>
							     
							<b-pagination name="pagination" size="md" :total-rows="meals.length" v-model="currentPage" :per-page="perPage"/>
			        	</div>

			        	<div v-if="showAllMeal==true">
							<b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsAllMeals"
							:items="allMeals"  :current-page="currentPage" :perPage="perPage">						
								<template slot="show_details" slot-scope="row">
							      <b-button size="sm" @click.stop="row.toggleDetails() ;currentMeal=row.item;getOrders()" class="mr-2">
							       {{ row.detailsShowing ? 'Hide' : 'Show'}} Details
							      </b-button>
							    </template>					      
							    <template slot="row-details" slot-scope="row">
							      <b-card>
       							 	<tr v-for="order in orders" :key ="order.id">
								        <b-row class="mb-3">
								          <b-col sm="auto" class="text-sm-right"><b>Order Id: {{ order.id }}</b></b-col>
								          <b-col sm="auto" class="text-sm-right"><b>State: {{ order.state }}</b></b-col>
								          <b-col sm="auto" class="text-sm-right"><b>Item Id: {{ order.item_id }}</b></b-col>
								          <b-col sm="auto" class="text-sm-right"><b>Meal Id: {{ order.meal_id }}</b></b-col>
								          <b-col sm="auto" class="text-sm-right"><b>Cook: {{ order.responsible_cook_id }}</b></b-col>
								        </b-row>
							        </tr>
							        <b-button size="sm" @click="row.toggleDetails">Hide Details</b-button>
							      </b-card>
							    </template>
							</b-table>
							<b-pagination name="pagination" size="md" :total-rows="allMeals.length" v-model="currentPage" :per-page="perPage"/>
			        	</div>

			        	<div v-if="showOrder==true">
							<b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsOrders"
							:items="orders"  :current-page="currentPage" :perPage="perPage">
							      <template slot="show" slot-scope="row">
								      <!-- we use @click.stop here to prevent emitting of a 'row-clicked' event  -->
								      
								     </template>
							</b-table>
							     
							<b-pagination name="pagination" size="md" :total-rows="orders.length" v-model="currentPage" :per-page="perPage"/>
			        	</div>

			        	<div v-if="showInvoice==true">
							<b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsInvoices"
							:items="invoices"  :current-page="currentPage" :perPage="perPage">
								<template slot="show" slot-scope="row">

								</template>
							</b-table>
							     
							<b-pagination name="pagination" size="md" :total-rows="invoices.length" v-model="currentPage" :per-page="perPage"/>
			        	</div>
							
   				 </template>
        	</div>
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
                	{key :'table_number',sortable:true},
                	{key :'start',sortable:true},
                	{key :'end',sortable:true},
                	{key :'responsible_waiter_id',sortable:true},
                	{key :'total_price_preview',sortable:true},
                	{key :'Actions'},
                	{key :'show'},
            		],
                fieldsAllMeals:[
                	{key :'id',sortable:true},
                	{key :'state',sortable:true},
                	{key :'table_number',sortable:true},
                	{key :'start',sortable:true},
                	{key :'end',sortable:true},
                	{key :'responsible_waiter_id',sortable:true},
                	{key :'total_price_preview',sortable:true},
                	{key :'show_details'},
            		],
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
                urlInvoicesAll:'/api/invoicesInfoAll',
                urlMeals:'/api/mealsInfo',
                urlOrders:'/api/mealsSummary/',
                check:"meals",
                invoices:[],
                meals:[],
                allMeals:[],
                orders:[],
                currentPage:1,
                perPage:5,
                showOrder:null,
                showMeal:true,
                showAllMeal:null,
                showInvoice:null,
                currentMeal:null,
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
           getInvoicesAll(){
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
           getAllMeals(){
           	let $this=this;
                axios.get('api/mealsInfoAll')
                    .then(response=>{
                        this.allMeals = response.data.data; 
                        //$this.makePagination(response.data);
                    });
           },
           getOrders(meal){
           	console.log("mealmeal")
           	console.log(this.currentMeal)
           	let $this=this;
                axios.get(this.urlOrders +this.currentMeal.id)
                    .then(response=>{
                        this.orders = response.data.data; 
       					console.log(response.data.data)
                        
                    }).catch(error=>{console.log(error)});
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
            mealNotPaid(meal){
				axios.patch('api/mealNotPaid/'+this.currentMeal.id, this.currentMeal)
	                .then(response=>{
						console.log(response.data);
	                	Object.assign(meal, response.data);
	                });
            }
        },
        mounted() {
        	this.getMeals();
        }

    }
</script>

<style scoped>  
p {
    font-size: 2em;
    text-align: center;
}
</style>