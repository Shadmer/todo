<template>
    <section class="registration">
        <form class="form" @submit.prevent="register">
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
                       type="password"
                       placeholder=""
                       required
                />
            </label>
            <label class="form__item">
                <span>Повторите пароль:</span>
                <input class="input"
                       v-model="repeatedPassword"
                       type="password"
                       placeholder=""
                       required
                />
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
            clearError() {
                this.$emit('clearError');
            },
            changeMode() {
                this.$emit('changeMode', 0);
            },
            register() {
                if (this.password !== this.repeatedPassword) {
                    //todo сделать нормальный вывод ошибок
                    alert('Пароли не совпадают!');
                    return;
                }

                let data = {
                    'login': this.login,
                    'password': this.password,
                };

                this.$store.dispatch('users/registration', data).then(
                    response => {
                        this.login = '';
                        this.password = '';
                        this.repeatedPassword = '';
                        this.$router.push('/');
                    },
                    error => {
                        this.$emit('setError', error.response.data);
                    }
                );
            },
        }

    }
</script>

<style lang="less">

</style>