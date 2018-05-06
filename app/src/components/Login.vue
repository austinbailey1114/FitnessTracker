<template lang="html">
    <div>
        <h1>Login to Fitness Tracker</h1>
		<form id="form" method="post">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button @click.prevent="login()">Login</button>
		</form>
	</div>
</template>

<script>
import $ from 'jquery'
import { mapMutations } from 'vuex'
import { mapGetters } from 'vuex'

export default {
    methods: {
        login: function(event) {
            console.log('login run');
            $.post(
                'http://localhost:8080/api/auth/signin',
                $('#form').serialize()
            ).done(function(data) {
                if (data['success']) {
                    this.setKey(data['key']);
                    this.$router.push({ path: '/' })
                } else {
                    console.log(data);
                }
            }.bind(this));
        },
        ...mapMutations([
            'setKey'
        ]),
    }
}
</script>

<style lang="css">

</style>
