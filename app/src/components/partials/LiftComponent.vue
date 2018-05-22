<template lang="html">
    <div class="lifts-container container">
        <div class="lift-graph inline container-child">
            <lift-history :lifts="lifts" :lifttypes="lifttypes"></lift-history>
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
</template>

<script>
import $ from 'jquery'
import { mapGetters } from 'vuex'
import LiftField from '@/components/partials/LiftField'
import LiftHistory from '@/components/partials/LiftHistory'

export default {
    components: {
        'lift-history': LiftHistory,
        'lift-field': LiftField
    },
    data: function() {
        return {
            lifts: [],
            lifttypes:[],
        }
    },
    created: function() {
        this.$http.get(
            'http://localhost:8080/api/lifts/' + this.getId()
        ).then(response => {
            var data = JSON.parse(response.bodyText);
            this.lifts = data;
        });

        this.$http.get(
            'http://localhost:8080/api/lifttypes/' + this.getId()
        ).then(response => {
            var data = JSON.parse(response.bodyText);
            this.lifttypes = data;
            this.selectedLiftChartType = data[0].name;
        });
    },
    methods: {
        postLift: function(event) {
            
            this.$http.post(
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
            ).then(response => {
                var dateString = this.getTonightMidnight();
                var newLift = {
                    weight: $('#lift-input-weight').val(),
                    reps: $('#lift-input-reps').val(),
                    type: $('#select-lift-type').val(),
                    date: dateString
                };
                this.lifts.push(newLift);
            });
        },
        getTonightMidnight: function() {
            var d = new Date();
            d.setHours(0,0,0,0);
            var month = d.getMonth() + 1;;
            var date = d.getDate();;
            if (d.getMonth() < 9) month = '0' + month;
            if (d.getDate() < 10) date = '0' + date;
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
