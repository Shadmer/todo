<template>
    <div class="cabinet">
        <h2>{{title}}</h2>
        <!--todo удалить ненужное-->
        <!--<button @click="mode = 0" class="btn">Авторизация</button>-->
        <!--<button @click="mode = 1" class="btn">Регистрация</button>-->
        <!--<button @click="mode = 2" class="btn">Кабинет</button>-->
        <!--appear-->
        <!--mode="out-in"-->
        <!--enter-active-class="animated slideInRight"-->
        <!--leave-active-class="animated slideOutRight"-->
        <!--todo нормальный вывод ошибок-->
        <div v-if="isError" class="error">{{errorMessage}}</div>
        <!--todo переделать на цикл-->
        <transition
        >
            <section is="Auth"
                     v-if="mode === 0"
                     @changeMode="setMode"
                     @setError="setError"
                     @clearError="clearError"
            ></section>
            <section is="Registration"
                     v-if="mode === 1"
                     @changeMode="setMode"
                     @setError="setError"
                     @clearError="clearError"
            ></section>
            <section is="Account"
                     v-if="mode === 2"
                     @changeMode="setMode"
                     @setError="setError"
                     @clearError="clearError"
            ></section>
        </transition>
    </div>
</template>

<script>
    import Registration from "@/components/Registration";
    import Auth from "@/components/Auth";
    import Account from "@/components/Account";
    import config from '../configs/errors';

    export default {
        name: "Cabinet",
        components: {
            Registration,
            Auth,
            Account,
        },
        created() {
            if (this.$store.state.users.user !== null) {
                this.mode = 2;
            }

        },
        data() {
            return {
                mode: 0,
                errorCode: '',
            }
        },
        computed: {
            title() {
                switch (this.mode) {
                    case 0:
                        return 'Авторизация';
                    case 1:
                        return 'Регистрация';
                    case 2:
                        return 'Личный кабинет';
                    default:
                        return 'Уходите :('
                }
            },
            isError() {
                return this.errorCode !== '';
            },
            errorMessage() {
                let error = this.errorCode !== ''
                    ? config.errors.find(error => error.code == this.errorCode.code)
                    : '';
                return error.message;
            },
        },
        methods: {
            setMode(mode) {
                this.mode = mode;
                this.clearError();
            },
            setError(errorCode) {
                this.errorCode = errorCode;
            },
            clearError() {
                this.errorCode = '';
            },
        }
    }
</script>

<style lang="less">
    h2 {
        border-bottom: 1px solid gray;
    }
</style>