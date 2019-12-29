<template>
    <div class="cabinet">
        <h2>{{getMode.title}}</h2>

        <transition
                enter-active-class="animated zoomIn"
                leave-active-class="animated zoomOut"
        >
            <div v-if="isError" class="cabinet__error">{{errorMessage}}</div>
        </transition>
        <transition
                appear
                mode="out-in"
                enter-active-class="animated slideInRight"
                leave-active-class="animated slideOutRight"
        >
            <section :is="getMode.mode"
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
    import config from '@/configs/errors';

    export default {
        name: "Cabinet",
        components: {
            Registration,
            Auth,
            Account,
        },
        mounted() {
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
            getMode() {
                switch (this.mode) {
                    case 0:
                        return {
                            title: 'Авторизация',
                            mode: 'Auth',
                        };
                    case 1:
                        return {
                            title: 'Регистрация',
                            mode: 'Registration',
                        };
                    case 2:
                        return {
                            title: 'Личный кабинет',
                            mode: 'Account',
                        };
                    default:
                        return {
                            title: 'Уходите',
                            mode: null,
                        };
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
        },
    }
</script>

<style lang="less">
    h2 {
        border-bottom: 1px solid gray;
    }

    .cabinet {
        &__error {
            margin-bottom: 10px;
            font-weight: bold;
            color: red;
        }
    }
</style>