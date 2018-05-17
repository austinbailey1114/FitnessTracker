<template lang="html">
    <div class="container">
        <div class="food-total container-child inline">
            <div class="food-total-field">
                <p class="food-total-prompt">Calories</p>
                <div id="cals" class="food-total-bar inline">
                    <div class="food-total-progess inline" :style="calsWidth">
                        <p class="food-total-value">{{ totals.cals }}</p>
                    </div>
                </div>
                <p class="food-total-goal inline">{{ goals.cals }}</p>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Fat</p>
                <div id="fat" class="food-total-bar">
                    <div class="food-total-progess inline" :style="fatWidth">
                        <p class="food-total-value">{{ totals.fat }}</p>
                    </div>
                </div>
                <p class="food-total-goal inline">{{ goals.fat }}</p>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Carbs</p>
                <div id="carbs" class="food-total-bar">
                    <div class="food-total-progess inline" :style="carbsWidth">
                        <p class="food-total-value">{{ totals.carbs }}</p>
                    </div>
                </div>
                <p class="food-total-goal inline">{{ goals.carbs }}</p>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Protein</p>
                <div id="protein" class="food-total-bar">
                    <div class="food-total-progess inline" :style="proteinWidth">
                        <p class="food-total-value">{{ totals.protein }}</p>
                    </div>
                </div>
                <p class="food-total-goal inline">{{ goals.protein }}</p>
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
                <p v-if="foods.length < 1" class="food-history-none">No recent foods to show</p>
                <span v-else>
                    <p v-for="food in foods" class="food-history-item">
                        {{ food }}
                    </p>
                </span>
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
                'fat': 41,
                'carbs': 71,
                'protein': 12
            },
            goals: {
                'cals': 1000,
                'fat': 70,
                'carbs': 80,
                'protein': 45,
            },
            barStyle: {
                height: '30px',
                zIndex: '3',
                position: 'absolute',
                backgroundColor: '#E74C3C',
                borderRadius: '10px',
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
                ...this.barStyle
            }
        },
        fatWidth: function() {
            var baseWidth = $('#fat').width();
            return {
                width: (this.totals.fat / this.goals.fat) * baseWidth + 'px',
                ...this.barStyle
            }
        },
        carbsWidth: function() {
            var baseWidth = $('#carbs').width();
            return {
                width: (this.totals.carbs / this.goals.carbs) * baseWidth + 'px',
                ...this.barStyle
            }
        },
        proteinWidth: function() {
            var baseWidth = $('#protein').width();
            return {
                width: (this.totals.protein / this.goals.protein) * baseWidth + 'px',
                ...this.barStyle
            }
        }
    }
}
</script>

<style lang="css">
.food-total-bar {
    height: 30px;
    width: 80%;
    background-color: #EEEEF2;
    border-radius: 10px;
    float: left;
}

.food-total-progress {
    background-color: red;
    height: 30px;
    float: left;
    position: absolute;
    z-index: 3;
}

.food-total-goal {
    font-weight: 200;
	padding: 7px 20px;
	font-size: 14px;
}

.food-history-none {
    font-weight: 200;
    font-size: 22px;
    padding: 10px;
    text-align: center;
}
</style>
