<template>
    <div>
        <div>{{user}}</div>
        <button class="btn" @click="logout">Выход</button>
    </div>
</template>

<script>
    export default {
        name: "Account",
        computed: {
            user() {
                return this.$store.state.users.user;
            }
        },
        methods: {
            changeMode() {
                this.$emit('changeMode', 0);
            },
            logout() {
                this.$store.dispatch('users/logout').then(
                    response => {
                        this.changeMode();
                    },
                    error => {
                        this.$emit('setError', error.response.data);
                    }
                );
            },
        }
    }
</script>

<style>

</style>