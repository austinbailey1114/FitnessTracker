<template lang="html">
    <div class="">
        <div>
            <h2 class="header-small inline">Your Lift Progress</h2>
            <a class="link-small inline" @click="showGraph=!showGraph">View as {{ viewAs }}</a>
        </div>
        <div v-show="showGraph">
            <div class="select-container">
                <select v-model="selectedLiftChartType" class="select">
                    <option v-for="type in lifttypes" :val="type.name">{{ type.name }}</option>
                </select>
            </div>
            <div class="lift-chart-container">
                <chart id="lift-chart" :axes="getLiftAxes"></chart>
            </div>
        </div>
        <div v-show="!showGraph">
            <p v-for="lift in lifts">{{ lift }}</p>
        </div>
    </div>
</template>

<script>
import Graph from '@/components/partials/Chart.vue'

export default {
    props: ['lifts', 'lifttypes'],
    components: {
        'chart': Graph
    },
    data: function() {
        return {
            showGraph: true,
            selectedLiftChartType: null,
        }
    },
    watch: {
        lifttypes: function() {
            this.selectedLiftChartType = this.lifttypes[0].name
        }
    },
    computed: {
        getLiftAxes: function() {
            var type = this.selectedLiftChartType;
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
                    }

                }
            }

            // Convert dates to neater format
            for (var i = 0; i < xAxis.length; i++) {
                var element = new Date(xAxis[i]);
                var newDate = (element.getMonth() + 1) + "/" + element.getDate() + "/" + element.getFullYear();
                xAxis[i] = newDate;
            }

            return { xAxis: xAxis, yAxis: yAxis };
        },
        viewAs: function() {
            if (this.showGraph) return "Table";
            return "Graph"
        },
    }
}
</script>

<style lang="css">
</style>
