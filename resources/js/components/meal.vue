<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>

        <meal-list :meals="meals"  @message="childMessage" ref="mealsListRef"></meal-list>

        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
    </div>              
</template>

<script type="text/javascript">
    import MealList from './mealList.vue';
    
    export default {
        data: function(){
            return { 
                title: 'List Meals',
                showSuccess: false,
                successMessage: '',
                currentUser: null,
                meals: [],
            }
        },
        methods: {
            getMeals: function(){
                axios.get('api/meals')
                    .then(response=>{this.meals = response.data.data; });
            },
            childMessage: function(message){
                this.showSuccess = true;
                this.successMessage = message;
            }
        },
        components: {
            'meal-list': MealList
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