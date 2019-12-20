<template>
    <section class="registration">
        <form class="form" @submit.prevent="register">
            <label class="form__item">
                <span>Логин:</span>
                <input class="input" required v-model="login" type="text" placeholder=""/>
            </label>
            <label class="form__item">
                <span>Пароль:</span>
                <input class="input" required v-model="password" type="password" placeholder=""/>
            </label>
            <label class="form__item">
                <span>Повторите пароль:</span>
                <input class="input" required v-model="repeatedPassword" type="password" placeholder=""/>
            </label>
            <div class="form__btn-block">
                <button class="btn" type="submit">Зарегистрироваться</button>
                <a @click="changeMode">Перейти к авторизации >></a>
            </div>
        </form>
    </section>
</template>

<script>
    export default {
        name: "Registration",
        data() {
            return {
                login: '',
                password: '',
                repeatedPassword: '',
            }
        },
        methods: {
            changeMode() {
                this.$emit('changeMode', 0);
            },
            register() {
                if (this.password !== this.repeatedPassword) {
                    alert('Пароли не совпадают!');
                    return;
                }

                let data = {
                    'login': this.login,
                    'password': this.password,
                };

                this.$store.dispatch('users/registration', data).then(
                    respones => {
                        this.login = '';
                        this.password = '';
                        this.repeatedPassword = '';
                        // this.$router.push('/');
                    },
                    error => {
                        //todo обработка ошибок
                        console.log('не зарегистрирую!');
                    }
                );
            },
        }

    }
</script>

<style lang="less">

</style>