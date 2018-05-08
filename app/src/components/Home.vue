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
            <lift-component></lift-component>
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
        </div>
    </div>
</template>
<script>
import '@/assets/css/index.css'
import $ from 'jquery'
import { mapGetters } from 'vuex'
import BodyweightHistory from '@/components/partials/BodyweightHistory'
import LiftComponent from '@/components/partials/LiftComponent'

export default {
    components: {
        'bodyweight-history': BodyweightHistory,
        'lift-component': LiftComponent
    },
    data: function() {
        return {
            name: 'Austin Bailey',
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
