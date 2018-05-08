<template lang="html">
    <div>
        <div>
            <p class="header-small inline no-select">Bodyweight</p>
            <a class="link-small inline no-select" @click="showGraph=!showGraph">View as {{ viewAs }}</a>
        </div>
        <div v-show="showGraph" class="bodyweight-chart-container">
            <chart id="bodyweight-chart" :axes="getBodyweightAxes"></chart>
        </div>
        <div v-show="!showGraph">
            <div class="underline">
                <p class="table-item inline">Weight</p>
                <p class="table-item inline">Date</p>
            </div>
            <div class="overflow-y">
                <div v-for="bodyweight in bodyweights" class="table-row">
                    <p class="table-item inline">{{ bodyweight.weight }}</p>
                    <p class="table-item inline">{{ bodyweight.date }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Graph from '@/components/partials/Chart.vue'
export default {
    props: ['bodyweights'],
    components: {
        'chart': Graph,
    },
    data: function() {
        return {
            showGraph: true,
        }
    },
    methods: {
        deleteBodyweight: function(id) {
            console.log(id);
        },
    },
    computed: {
        getBodyweightAxes: function() {
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
            return { xAxis: xAxis, yAxis, yAxis }
        },
        viewAs: function() {
            if (this.showGraph) return "Table";
            return "Graph";
        },
    }
}
</script>

<style lang="css">
</style>
