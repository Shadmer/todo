<template>
    <div class="cabinet">
        <h2>{{title}}</h2>
        <transition
            appear
            mode="out-in"
            enter-active-class="animated slideInRight"
            leave-active-class="animated slideOutRight">
            <section is="Auth"
                     v-if="mode === 0"
                     @changeMode="setMode"
            ></section>
            <section is="Registration"
                     v-if="mode === 1"
                     @changeMode="setMode"
            ></section>
            <section is="Account"
                     v-if="mode === 2"></section>
        </transition>
    </div>
</template>

<script>
    import Registration from "@/components/Registration";
    import Auth from "@/components/Auth";
    import Account from "@/components/Account";

    export default {
        name: "Cabinet",
        components: {
            Registration,
            Auth,
            Account,
        },
        data() {
            return {
                mode: 0
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
            }
        },
        methods: {
            setMode(mode) {
                this.mode = mode;
            }
        }
    }
</script>

<style lang="less">
    h2 {
        border-bottom: 1px solid gray;
    }
</style>