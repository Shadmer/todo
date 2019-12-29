<template>
    <div class="account">
        <div class="account__name">Вы вошли как <b>{{user.name}}</b></div>
        <br>
        <button class="btn" @click="logout">Выход</button>
    </div>
</template>

<script>
    export default {
        name: "Account",
        computed: {
            user() {
                return this.$store.state.users;
            }
        },
        methods: {
            changeMode() {
                this.$emit('changeMode', 0);
            },
            logout() {
                this.$store.dispatch('users/logout').then(
                    () => {
                        this.$store.commit('tasks/SET_TASKS', []);
                        this.$store.commit('categories/SET_CATEGORIES', []);
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