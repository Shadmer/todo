<template>
    <div class="navigation">
        <router-link
            v-for="(route, index) in routes"
            :key="index"
            :to="route.path"
            class="navigation__link"
        >
           {{route.name}}
        </router-link>
    </div>
</template>

<script>
    export default {
        name: 'Navigation',
        data() {
            return {

            }
        },
        computed: {
            routes() {
                return this.$router.options.routes
            }
        }
    }
</script>

<style lang="less">
    .navigation {
        display: flex;

        &__link {
            flex-basis: 25%;
            padding: 20px;
            text-align: center;
            color: @text-color;
            background-color: @color;
            border: 1px solid @color--accent;
            border-right: none;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;

            &:last-child {
                border-right: 1px solid @color--accent;
            }

            &:hover {
                color: @color--gray;
            }


        }
    }

    .router-link-active, .router-link-exact-active {
        color: @text-color--accent !important;
        background-color: @color--gray;
        border: none;
        text-decoration: none;
        transform: scale(1.1);
        transition: all .3s;

        &:focus {
            text-decoration: none;
        }
    }
</style>
