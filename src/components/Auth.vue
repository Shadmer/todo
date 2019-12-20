<template>
    <section class="auth">
        <form class="form  form--second" @submit.prevent="auth">
            <label class="form__item">
                <span>Логин:</span>
                <input class="input" required v-model="login" type="text" placeholder=""/>
            </label>
            <label class="form__item">
                <span>Пароль:</span>
                <input class="input" required v-model="password" type="password" placeholder=""/>
            </label>
            <div class="form__btn-block">
                <button class="btn" type="submit">Войти</button>
                <label class="form__save">
                    <input type="checkbox">
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
            }
        },
        methods: {
            changeMode() {
                this.$emit('changeMode', 1);
            },
            auth() {
                let data = {
                    'login': this.login,
                    'password': this.password,
                };

                this.$store.dispatch('users/auth', data).then(
                    respones => {
                        this.login = '';
                        this.password = '';
                        this.$router.push('/');
                    },
                    error => {
                        //todo обработка ошибок
                        console.log('не авторизую!');
                    }
                );
            },
        }
    }
</script>

<style scoped>

</style>