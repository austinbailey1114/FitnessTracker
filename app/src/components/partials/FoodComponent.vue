<template lang="html">
    <div class="container">
        <div class="food-total container-child inline">
            <div class="food-total-field">
                <p class="food-total-prompt">Calories</p>
                <p class="food-total-value"></p>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Fat</p>
                <p class="food-total-value"></p>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Carbs</p>
                <p class="food-total-value"></p>
            </div>
            <div class="food-total-field">
                <p class="food-total-prompt">Protein</p>
                <p class="food-total-value"></p>
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
export default {
}
</script>

<style lang="css">
</style>
