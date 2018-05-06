<template lang="html">
    <div>
        <!-- https://dribbble.com/shots/4549955-Daily-18 -->
        <link rel="stylesheet" href="#">
        <div class="top">
            <div class="top-left inline">
                <div class="title inline">
                    <img class="image" src="@/assets/images/hugeIcon.png" height="40" width="40">
                    <p class="header" align="center">Dashboard</p>
                </div>
                <div class="links-container inline">
                    <a href="https://github.com/austinbailey1114/LiftAppSite" class="link">About</a>
                    <a href="https://github.com/austinbailey1114/iOS" class="link">The App</a>
                </div>
            </div>
            <div class="dropdown inline">
                <a class="link name" href="#">{{ name }}</a>
                <div class="drop-content">
                    <a href="#" class="link">Log Out</a>
                </div>
            </div>
            <!--<img class="userIcon" src="./images/userIcon.png" height="52" width="52">-->
        </div>
        <div class="dashboard">
            <div class="lifts-container container">
                <div class="lift-graph inline container-child">
                    <div>
                        <h2 class="header-small inline">Your Lift Progress</h2>
                        <a class="link-small inline" href="">View as Table</a>
                    </div>
                    <div class="select-container">
                        <select class="select" id="choose-lift">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="lift-chart-container">
                        <canvas id="lift-chart"></canvas>
                    </div>
                </div>
                <div class="new-lift inline container-child">
                    <form action="" method="post">
                        <div class="lift-field">
                            <p class="lift-prompt">Weight</p>
                            <input class="numeric-input lift-input" type="text" name="weight" placeholder="pounds" autocomplete="off">
                        </div>
                        <div class="lift-field">
                            <p class="lift-prompt">Reps</p>
                            <input class="numeric-input lift-input" type="text" name="reps" placeholder="repetitions" autocomplete="off">
                        </div>
                        <div class="lift-field">
                            <p class="lift-prompt">Date</p>
                            <input id="date-input" class="lift-input" type="text" name="date" placeholder="today" autocomplete="off">
                        </div>
                        <div class="lift-field">
                            <p class="lift-prompt inline">Type</p>
                            <select id="select-lift-type" class="select select-wide" name='liftType'>
                                <option value="select">-- Select Type--</option>
                                <option value="new">New</option>
                                    <option value=""></option>
                            </select>
                            <div id="newType" style="display: none">
                                <button id='exitNewLift' type=button>
                                    <img src="@/assets/images/xicon.png" height='15' width='15' style='margin-right: 5px;'>
                                </button>
                                <input class="lift-input" type='text' name='newType' id='typeInput' placeholder='new type' autocomplete='off'>
                            </div>
                        </div>
                        <button class="form-submit">Save Lift</button>
                    </form>
                </div>
            </div>
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
            <div class="container">
                <div class="bodyweight-graph container-child inline">
                    <div>
                        <p class="header-small inline">Bodyweight</p>
                        <a class="link-small inline" href="">View as Table</a>
                    </div>
                    <div class="bodyweight-chart-container">
                        <canvas id="bodyweight-chart"></canvas>
                    </div>
                </div>
                <div class="new-weight container-child inline">
                    <form class="bodyweight-form" action="" method="post">
                        <div class="bodyweight-field">
                            <p class="bodyweight-field-prompt">Weight</p>
                            <input class="numeric-input bodyweight-input" type="text" name="weight" placeholder="pounds">
                        </div>
                        <button class="form-submit form-submit-bodyweight">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import '@/assets/css/index.css'
import $ from 'jquery'
import { mapGetters } from 'vuex'

export default {
    data: function() {
        return {
            name: 'Austin Bailey'
        }
    },
    mounted: function() {
        console.log(this.key());
    },
    methods: {
        ...mapGetters([
            'key'
        ])
    }
}
</script>

<style lang="css">

</style>
