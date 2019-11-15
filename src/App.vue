<template>
    <div id="app" class="app">
        <div is="Stub"></div>
        <main class="app__main">
            <div class="app__container">
                <div class="app__content">
                    <nav class="app__nav" is="navigation"></nav>
                    <div class="app__inner">
                        <div class="app__inner-head"></div>
                        <div class="app__inner-wrap">
                            <transition
                                appear
                                mode="out-in"
                                enter-active-class="animated slideInDown"
                                leave-active-class="animated slideOutUp">
                                <router-view/>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import Navigation from '@/components/Navigation';
    import Stub from '@/components/Stub';

    export default {
        name: 'App',
        components: {
            Navigation,
            Stub
        },
        created() {
            this.$store.dispatch('tasks/getTasks').then(
                response => {
                    
                },
                error => {
                    console.log(error.response);
                }
            );

            this.$store.dispatch('categories/getCategories');
        },
        data() {
            return {
                routes: this.$router.options.routes,
            }
        }
    }
</script>

<style lang="less">
    @import "./assets/styles/normalize.css";
    @import "./assets/styles/animate.css";
    @import "./assets/styles/scaffolding";
    @import "./assets/styles/variables";
    @import "./assets/styles/style";

    .app {
        display: flex;
        min-height: 100vh;
        flex-direction: column;

        &__main {
            flex: auto;
            padding-top: 100px;
            padding-bottom: 50px;
            background-image: url('./assets/img/table.jpg');
        }

        &__container {
            .wrapper();
        }

        &__content {
            position: relative;
            width: 840px;
            margin: 0 auto;
        }

        &__nav {
            position: absolute;
            right: 100%;
            top: 0;
            bottom: 0;
            z-index: 1;
        }

        &__inner {
            position: relative;
            min-height: 400px;
            padding: 60px 40px 20px;
            background-color: #fff;
            border: 5px solid #eff2f7;
            box-shadow: -10px 10px 10px 0px rgba(0, 0, 0, 0.75);

            &::before {
                content: '';
                position: absolute;
                bottom: -18px;
                height: 15px;
                left: 5px;
                right: 5px;
                background-color: #fff;
                border: 3px solid #eff2f7;
                box-shadow: -10px 10px 10px 0px rgba(0, 0, 0, 0.75);
            }

            &::after {
                content: '';
                position: absolute;
                bottom: -27px;
                height: 12px;
                left: 15px;
                right: 15px;
                background-color: #fff;
                border: 3px solid #eff2f7;
                box-shadow: -10px 10px 10px 0px rgba(0, 0, 0, 0.75);
            }
        }

        &__inner-head {
            content: '';
            position: absolute;
            top: -66px;
            left: 0;
            right: 0;
            height: 120px;
            background-image: url("./assets/img/clinch.png");
        }

        &__inner-wrap {
            overflow: hidden;
         }
    }
</style>
