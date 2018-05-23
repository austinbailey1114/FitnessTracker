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
            <food-component></food-component>
            <bodyweight-component></bodyweight-component>
        </div>
    </div>
</template>
<script>
import '@/assets/css/index.css'
import { mapGetters } from 'vuex'
import LiftComponent from '@/components/partials/LiftComponent'
import FoodComponent from '@/components/partials/FoodComponent'
import BodyweightComponent from '@/components/partials/BodyweightComponent'

export default {
    components: {
        'lift-component': LiftComponent,
        'food-component': FoodComponent,
        'bodyweight-component': BodyweightComponent
    },
    data: function() {
        return {
            name: 'Austin Bailey',
        }
    }
}
</script>

<style lang="css">

</style>
