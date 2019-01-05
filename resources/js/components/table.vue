<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
    	<div class="content">
        	<div class="panel">
	        	<template>
                    <div>
                        <b-button size="sd" @click.stop="registerTable(restaurant_table)" class="mr-2"> Create a Table</b-button> 
                        <input class="mr-2" type="number" min="1" v-model="restaurant_table.table_number" placeholder="Table Number">
                    </div>
			        	<div >
							<b-table striped hover :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" :fields="fieldsTables"
							:items="tables"  :current-page="currentPage" :perPage="perPage">
							      <template slot="action" slot-scope="row">
								      <!-- we use @click.stop here to prevent emitting of a 'row-clicked' event  -->
								      <b-button size="sm" @click.stop="deleteTable(row.item)" class="mr-2">
								      Delete
								      </b-button>
								     </template>
							</b-table>
							     
							<b-pagination name="pagination" size="md" :total-rows="tables.length" v-model="currentPage" :per-page="perPage"/>
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
                title: 'Tables',
                fieldsTables:[
                    {key :'table_number',sortable:true},
                	{key :'action'},
            		],
            	sortBy:"table_number",
            	sortDesc:false,
                urlTables:'/api/tables',
                tables:[],
                restaurant_table:{
                    table_number:null,
                },
                currentPage:1,
                perPage:5,
                currentTable:"",
                /*chartOptions: {
			        chart: {
						title: 'Company Performance',
						subtitle: 'Sales, Expenses, and Profit: 2014-2017',
			        }
				}*/
            }
        },
        methods: {
            getTables(){
                let $this=this;
                axios.get(this.urlTables)
                    .then(response=>{
                        this.tables = response.data.data; 
                });
            },
            deleteTable: function(table){
                this.currentTable=table;
                axios.delete('api/tables/'+this.currentTable.table_number)
                    .then(response => {
                        this.showSuccess = true;
                        this.successMessage = 'Table Deleted';
                        this.getTables();
                    }).catch(error=>{
                        console.log(error);
                    })
                    this.currentItem=null;
            },
            registerTable: function(table){
                //if()
                this.currentTable=table;
                axios.post('api/tables',this.currentTable)
                    .then(response=>{
                       
                        this.getTables();
                        //this.tables.push(response.data)
                        //Object.assign(this.tables, response.data.data);
                        /*this.typeofmsg = "alert-success";
                        this.message = "Worker registered correctly.";
                        this.showMessage = true;
                        //this.$emit('user-saved', this.user)*/
                    }).catch(error=>{
                        /*this.typeofmsg = "alert-danger";
                        this.message = "Error registering worker.";
                        this.showMessage = true;*/
                        console.log(error);
                });
            },  
        },

        mounted() {
        	this.getTables();
        }

    }
</script>

<style scoped>  
p {
    font-size: 2em;
    text-align: center;
}
</style>