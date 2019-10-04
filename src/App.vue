<template>
    <div id="app" class="app">
        <main class="app__main">
            <div class="app__container">
                <nav class="app__nav">
                    <navigation/>
                </nav>
                <div class="app__content">
                    <router-view/>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import Navigation from '@/components/Navigation';

    export default {
        name: 'App',
        components: {
            Navigation
        },
        created() {
            this.$store.dispatch('tasks/getTasks');
        },
        data() {
            return {
                routes: this.$router.options.routes
            }
        },
        methods: {}
    }
</script>

<style lang="less">
    @import "./assets/styles/normalize.css";
    @import "./assets/styles/scaffolding";
    @import "./assets/styles/variables";
    @import "./assets/styles/style";

    .app {
        display: flex;
        min-height: 100vh;
        flex-direction: column;

        &__main {
            flex: auto;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        &__container {
            .wrapper();
        }

        &__nav {

        }

        &__content {
            min-height: 80vh;
            padding: 20px 40px;
            border: 1px solid black;
        }
    }
</style>
