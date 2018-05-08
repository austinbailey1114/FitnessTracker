<template lang="html">
    <div class="container">
        <div class="bodyweight-graph container-child inline">
            <bodyweight-history :bodyweights="bodyweights"></bodyweight-history>
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
</template>

<script>
import $ from 'jquery'
import { mapGetters } from 'vuex'
import BodyweightHistory from '@/components/partials/BodyweightHistory'

export default {
    components: {
        'bodyweight-history': BodyweightHistory
    },
    data: function() {
        return {
            bodyweights: [],
        }
    },
    created: function() {
        $.get(
            'http://localhost:8080/api/bodyweights/' + this.getId(),
        ).done(function(data) {
            this.bodyweights = data;
        }.bind(this));
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
            }.bind(this));
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
