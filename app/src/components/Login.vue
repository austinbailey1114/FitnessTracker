<template lang="html">
    <div>
        <h1>Login to Fitness Tracker</h1>
		<form id="form" method="post">
			<input id="username" type="text" name="username" placeholder="Username">
			<input id="password" type="password" name="password" placeholder="Password">
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
            this.$http.post(
                'http://localhost:8080/api/auth/signin',
                {
                    username: $('#username').val(),
                    password: $('#password').val()
                }
            ).then(response => {
                console.log(response);
                var data = JSON.parse(response.bodyText);
                if (data['success']) {
                    this.setKey(data['key']);
                    this.setId(data['id']);
                    this.$router.push({ path: '/' })
                } else {
                    console.log(data);
                }
            });
        },
        ...mapMutations([
            'setKey',
            'setId'
        ]),
    }
}
</script>

<style lang="css">

</style>
