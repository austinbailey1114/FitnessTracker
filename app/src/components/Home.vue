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
        </div>
        <div class="dashboard">
            <div class="lifts-container container">
                <div class="lift-graph inline container-child">
                    <div>
                        <h2 class="header-small inline">Your Lift Progress</h2>
                        <a class="link-small inline" href="">View as Table</a>
                    </div>
                    <div class="select-container">
                        <select @change="buildLiftChart()" v-model="selectedLiftChartType" class="select" id="choose-lift">
                            <option v-for="type in lifttypes" :val="type.name">{{ type.name }}</option>
                        </select>
                    </div>
                    <div class="lift-chart-container">
                        <canvas id="lift-chart"></canvas>
                    </div>
                </div>
                <div class="new-lift inline container-child">
                    <form>
                        <lift-field id="lift-input-weight" name="weight" prompt="Weight"></lift-field>
                        <lift-field id="lift-input-reps" name="reps" prompt="Reps"></lift-field>
                        <lift-field id="date-input" name="date" prompt="Date"></lift-field>
                        <div class="lift-field">
                            <p class="lift-prompt inline">Type</p>
                            <select id="select-lift-type" class="select select-wide" name='liftType'>
                                <option value="select">-- Select Type--</option>
                                <option value="new">New</option>
                                <option v-for="type in lifttypes" :val="type.name">{{ type.name }}</option>
                            </select>
                            <div id="newType" style="display: none">
                                <button id='exitNewLift' type=button>
                                    <img src="@/assets/images/xicon.png" height='15' width='15' style='margin-right: 5px;'>
                                </button>
                                <input id="lift-input-type" class="lift-input" type='text' name='newType' placeholder='new type' autocomplete='off'>
                            </div>
                        </div>
                        <button @click.prevent="postLift()" class="form-submit">Save Lift</button>
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
                    <form class="bodyweight-form" method="post">
                        <div class="bodyweight-field">
                            <p class="bodyweight-field-prompt">Weight</p>
                            <input id="new-bodyweight-input" class="numeric-input bodyweight-input" type="text" name="weight" placeholder="pounds">
                        </div>
                        <button @click.prevent="postBodyweight()" class="form-submit form-submit-bodyweight">Update</button>
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
import Chart from 'chart.js'
import LiftField from '@/components/partials/LiftField'

export default {
    components: {
        'lift-field': LiftField,
    },
    data: function() {
        return {
            name: 'Austin Bailey',
            lifts: [],
            bodyweights: [],
            lifttypes: [],
            selectedLiftChartType: null
        }
    },
    created: function() {
        $.get(
            'http://localhost:8080/api/lifts/' + this.getId(),
        ).done(function(data) {
            this.lifts = data;
        }.bind(this));

        $.get(
            'http://localhost:8080/api/lifttypes/' + this.getId(),
        ).done(function(data) {
            this.lifttypes = data;
            this.selectedLiftChartType = data[0].name;
            this.buildLiftChart();
        }.bind(this));

        $.get(
            'http://localhost:8080/api/bodyweights/' + this.getId(),
        ).done(function(data) {
            this.bodyweights = data;
            this.buildWeightChart();
        }.bind(this));
    },
    mounted: function() {
        console.log(this.getKey(), this.getId());
    },
    methods: {
        postBodyweight: function() {
            $.post(
                'http://localhost:8080/api/bodyweights/',
                {
                    weight: $('#new-bodyweight-input').val(),
                    key: this.getKey(),
                    user: this.getId()
                }
            ).done(function(data) {
                var dateString = this.getTonightMidnight();
                var newBodyweight = {
                    date: dateString,
                    weight: $('#new-bodyweight-input').val()
                };
                this.bodyweights.push(newBodyweight);
                this.buildWeightChart();
            }.bind(this));
        },
        postLift: function(event) {
            $.post(
                'http://localhost:8080/api/lifts/',
                {
                    weight: $('#lift-input-weight').val(),
                    reps: $('#lift-input-reps').val(),
                    date: $('#date-input').val(),
                    type: $('#select-lift-type').val(),
                    liftType: $('#select-lift-type').val(),
                    key: this.getKey(),
                    user: this.getId()
                }
            ).done(function(data) {
                var dateString = this.getTonightMidnight();
                var newLift = {
                    weight: $('#lift-input-weight').val(),
                    reps: $('#lift-input-reps').val(),
                    type: $('#select-lift-type').val(),
                    date: dateString
                };
                this.lifts.push(newLift);
                this.buildLiftChart();
            }.bind(this));
        },
        buildLiftChart: function() {
            var type = this.selectedLiftChartType;
            console.log(type);
            var xAxis = [];
            var yAxis = [];
            for (var i = 0; i < this.lifts.length; i++) {
                // If the lift is of the selected type
                if(this.lifts[i].type == type) {
                    if (xAxis.length > 0) {
                        // Find the index of the date of the current item
                        var index = xAxis.findIndex(function(element) {
                            return element == this.lifts[i].date;
                        }.bind(this));
                        // If the date already exists, check if the corresponding lift (in the y axis) needs to be updated
                        if (index != -1) {
                            // Only change the lift if the 1RM of the current index is larger
                            if (yAxis[index] < (this.lifts[i].weight * (1 + (this.lifts[i].reps  / 30)))) {
                                yAxis[index] = this.lifts[i].weight * (1 + (this.lifts[i].reps  / 30));
                            }
                        } else {
                            xAxis.push(this.lifts[i].date);
                            yAxis.push(this.lifts[i].weight * (1 + (this.lifts[i].reps  / 30)));
                        }
                    } else {
                        xAxis.push(this.lifts[i].date);
                        yAxis.push(this.lifts[i].weight * (1 + (this.lifts[i].reps  / 30)));
                        console.log(this.lifts[i].date);
                    }

                }
            }

            // Convert dates to neater format
            for (var i = 0; i < xAxis.length; i++) {
                var element = new Date(xAxis[i]);
                var newDate = (element.getMonth() + 1) + "/" + element.getDate() + "/" + element.getFullYear();
                xAxis[i] = newDate;
            }

            var ctx = document.getElementById('lift-chart').getContext('2d');
            var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: xAxis,
                datasets: [{
                    borderColor: 'rgb(231,76,60)',
                    backgroundColor: 'rgba(231,76,60,0.3',
                    fill: true,
                    data: yAxis,
                    pointBackgroundColor: 'rgb(231,76,60)',

                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                 },
            }
            });

        },
        buildWeightChart: function() {
            var xAxis = [];
            var yAxis = [];
            for (var i = 0; i < this.bodyweights.length; i++) {
                xAxis.push(this.bodyweights[i].date);
                yAxis.push(this.bodyweights[i].weight);
            }

            // Convert dates to neater format
            for (var i = 0; i < xAxis.length; i++) {
                var element = new Date(xAxis[i]);
                var newDate = (element.getMonth() + 1) + "/" + element.getDate() + "/" + element.getFullYear();
                xAxis[i] = newDate;
            }

            var ctx = document.getElementById('bodyweight-chart').getContext('2d');
            var chart = new Chart(ctx, {
            	type: 'line',
            	data: {
            	    labels: xAxis,
            	    datasets: [{
            	        borderColor: 'rgb(231,76,60)',
            	        backgroundColor: 'rgba(231,76,60,0.3',
            	        fill: true,
            	        pointBackgroundColor: 'rgb(231,76,60)',
            	        data: yAxis,
            	    }]
            	},
            	options: {
            	    responsive: true,
            	    maintainAspectRatio: false,
            	    legend: {
            	        display: false
            	     },
            	}
            });
        },
        getTonightMidnight: function() {
            var d = new Date();
            d.setHours(0,0,0,0);
            var month;
            var date;
            month = d.getMonth() + 1;
            if (d.getMonth() < 9) {
                month = '0' + month;
            }
            if (d.getDate() < 10) {
                date = '0' + d.getDate();
            }
            return d.getFullYear() + '-' + month + '-' + date + " 00:00:00";
        },
        ...mapGetters([
            'getKey',
            'getId'
        ])
    }
}
</script>

<style lang="css">

</style>
