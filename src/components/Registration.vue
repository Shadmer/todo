<template>
    <section class="registration">
        <form class="form" @submit.prevent="register">
            <label class="form__item">
                <span>Логин:</span>
                <input class="input"
                       v-model="login"
                       @input="clearError"
                       type="text"
                       required
                />
            </label>
            <label class="form__item">
                <span>Пароль:</span>
                <input class="input"
                       :class="{registration__error: isError}"
                       v-model="password"
                       @input="clearError"
                       type="password"
                       required
                />
            </label>
            <label class="form__item">
                <span>Повторите пароль:</span>
                <input class="input"
                       :class="{registration__error: isError}"
                       v-model="repeatedPassword"
                       @input="clearError"
                       type="password"
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
                isError: false,
            }
        },
        methods: {
            clearError() {
                this.isError = false;
                this.$emit('clearError');
            },
            changeMode() {
                this.$emit('changeMode', 0);
            },
            register() {
                if (this.password !== this.repeatedPassword) {
                    this.isError = true;
                    this.$emit('setError', {code: 'bad_password'});
                    return;
                }

                let data = {
                    'login': this.login,
                    'password': this.password,
                };

                this.$store.dispatch('users/registration', data).then(
                    () => {
                        this.login = '';
                        this.password = '';
                        this.repeatedPassword = '';
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

<style lang="less">
    .registration {
        &__error {
            border-color: red;
        }
    }

</style>