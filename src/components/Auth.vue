<template>
    <section class="auth">
        <form class="form  form--second" @submit.prevent="auth">
            <label class="form__item">
                <span>Логин:</span>
                <input class="input"
                       v-model="login"
                       @input="clearError"
                       type="text"
                       placeholder=""
                       required
                />
            </label>
            <label class="form__item">
                <span>Пароль:</span>
                <input class="input"
                       v-model="password"
                       @input="clearError"
                       type="password"
                       placeholder=""
                       required
                />
            </label>
            <div class="form__btn-block">
                <button class="btn" type="submit">Войти</button>
                <label class="form__save">
                    <input v-model="isRemember" type="checkbox">
                    <span>Запомнить?</span>
                </label>
                <a @click="changeMode">Перейти к регистрации >></a>
            </div>
        </form>
    </section>
</template>

<script>
    export default {
        name: "Auth",
        data() {
            return {
                login: '',
                password: '',
                isRemember: false,
            }
        },
        methods: {
            changeMode() {
                this.$emit('changeMode', 1);
            },
            clearError() {
                this.$emit('clearError');
            },
            auth() {
                let data = {
                    'login': this.login,
                    'password': this.password,
                    'isRemember': Number(this.isRemember),
                };
                this.$store.dispatch('users/auth', data).then(
                    () => {
                        this.login = '';
                        this.password = '';
                        this.$store.dispatch('tasks/getTasks');
                        this.$store.dispatch('categories/getCategories');
                        this.$router.push('/tasks');
                    },
                    error => {
                        this.$emit('setError', error.response.data);
                    }
                );
            },
        }
    }
</script>

<style scoped>

</style>