<template lang="html">
    <div class="container">
        <div class="food-total container-child inline">
            <div class="food-total-field">
                <p class="food-total-prompt">Calories</p>
                <div id="cals" class="food-total-bar">
                    <div class="food-total-progess inline" :style="calsWidth">
                        <p class="food-total-value">{{ totals.cals }}</p>
                    </div>
                </div>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Fat</p>
                <div id="fat" class="food-total-bar">
                    <div class="food-total-progess inline" :style="fatWidth">
                        <p class="food-total-value">{{ totals.fat }}</p>
                    </div>
                </div>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Carbs</p>
                <div class="food-total-bar">
                    <div class="food-total-progess inline">

                    </div>
                    <p class="food-total-value inline">{{ totals.carbs }}</p>
                </div>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Protein</p>
                <div class="food-total-bar">
                    <div class="food-total-progess inline">

                    </div>
                    <p class="food-total-value inline">{{ totals.protein }}</p>
                </div>
            </div>
        </div>
        <div class="container-child inline food-stuff">
            <div class="new-food">
                <form class="food-form" action="#" method="post">
                    <input type="text" name="searchField" class="food-search" placeholder="Search food database">
                    <button class="form-submit food-search-button">Search</button>
                </form>
            </div>
            <div class="food-history">
                <p class="food-history-item"></p>
            </div>
        </div>
    </div>
</template>

<script>
import $ from 'jquery'

export default {
    data: function() {
        return {
            foods: [],
            totals: {
                'cals': 200,
                'fat': 40,
                'carbs': 89,
                'protein': 41
            },
            goals: {
                'cals': 1000,
                'fat': 70,
                'carbs': 80,
                'protein': 45,
            }
        }
    },
    mounted: function() {

    },
    computed: {
        calsWidth: function() {
            var baseWidth = $('#cals').width();
            return {
                width: (this.totals.cals / this.goals.cals) * baseWidth + 'px',
                height: '30px',
                zIndex: '3',
                position: 'absolute',
                backgroundColor: 'red'
            }
        },
        fatWidth: function() {
            var baseWidth = $('#fat').width();
            return {
                width: (this.totals.fat / this.goals.fat) * baseWidth + 'px',
                height: '30px',
                zIndex: '3',
                position: 'absolute',
                backgroundColor: 'red'
            }
        }
    }
}
</script>

<style lang="css">
.food-total-bar {
    height: 30px;
    width: 80%;
    background-color: pink;
    overflow: visible;
}

.food-total-progress {
    background-color: red;
    height: 30px;
    float: left;
    position: absolute;
    z-index: 3;
}
</style>
