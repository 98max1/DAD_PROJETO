<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>  

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <router-link to="/mealCreate" tag="button" class="btn btn-outline-secondary">Create Meal</router-link>
            </div>
        </div>
        <meal-summary :orders="orders" :table="table_order" :price="price_order" @message="childMessage" v-if="currentMeal" ></meal-summary>
        
        <meal-list :meals="meals"  @meal-click="summaryMeal"  @message="childMessage" ref="mealsListRef"></meal-list>

        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
    </div>              
</template>

<script type="text/javascript">
    import MealList from './mealList.vue';
    import MealSummary from './mealSummary.vue';
    import Vue from 'vue'
    import VueSwal from 'vue-swal'
    
    export default {
        data: function(){
            return { 
                title: 'List Meals',
                showSuccess: false,
                successMessage: '',
                currentUser: null,
                meals: [],
                errors:{},
                orders: [],
                table_order: null,
                currentMeal: null,
                price_order: null,
            }
            errors:{}
        },
        methods: {
            getMeals: function(){
                axios.get('api/meals')
                    .then(response=>{this.meals = response.data.data; });
            },
            summaryMeal: function(meal){
                this.currentMeal=meal;
                this.table_order = meal.table_number;
                this.price_order = meal.total_price_preview;
                axios.get('api/mealsSummary/'+this.currentMeal.id)
                    .then(response=>{this.orders = response.data.data; });
            
            },
            orderDeliver: function(){
                this.currentUser = null;
	            this.showSuccess = true;
                this.successMessage = 'Order Deliver';
            }, 
            
            orderDeliver: function(){
                this.currentUser = null;
	            this.showSuccess = true;
                this.successMessage = 'Order Deliver';
            }, 

            childMessage: function(message){
                this.showSuccess = true;
                this.successMessage = message;
            },
        },
        components: {
            'meal-list': MealList,
            'meal-summary': MealSummary,
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