<template>
    <nav class="navigation">
        <router-link
            v-for="(route, index) in routes"
            :key="index"
            :to="route.path"
            class="navigation__link"
            :style="{'borderColor':  getColor()}"
        >
           {{route.name}}
        </router-link>
    </nav>
</template>

<script>
    export default {
        name: 'Navigation',
        data() {
            return {}
        },
        computed: {
            routes() {
                let routes = this.$router.options.routes;
                let cabinet = "/cabinet";
                let user = this.$store.state.users.user;

                let filtered = routes.filter(route => {
                    if (user === null) {
                        return route.path === cabinet && route.name !== 'NotFound';
                    } else {
                        return route.name !== 'NotFound';
                    }
                });

                return filtered;
            },
        },
        methods:{
            getColor() {
                return 'rgb(' +
                    Math.floor(Math.random() * 256) +
                    ',' +
                    Math.floor(Math.random() * 256) +
                    ',' +
                    Math.floor(Math.random() * 256) +
                    ')';
            }
        }
    }
</script>

<style lang="less">
    .navigation {
        display: flex;
        flex-direction: column;
        padding-top: 60px;

        &__link {
            width: 105px;
            margin-top: 20px;
            padding: 5px;
            text-align: center;
            color: @text-color;
            background-color: #eff2f7;
            border: 10px solid;
            border-right: 0;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            transition: all .3s;

            &:hover {
                box-shadow: -6px 10px 5px 0px rgba(0,0,0,0.75);
                transition: all .3s;
            }
        }
    }

    .router-link-exact-active {
        width: 115px;
        margin-right: -15px;
        text-decoration: none;
        box-shadow: -10px 10px 5px 0px rgba(0,0,0,0.75);
        transition: all .3s;

        &:focus {
            text-decoration: none;
        }

        &:hover {
            box-shadow: -10px 10px 5px 0px rgba(0,0,0,0.75);
        }
    }
</style>
