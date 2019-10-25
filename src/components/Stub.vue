<template>
    <div class="stub" v-if="isStub" @click="closeStub()"></div>
</template>

<script>
    export default {
        name: "Stub",
        computed: {
            isStub() {
                return this.$store.state.stub.status;
            }
        },
        methods: {
            closeStub() {
                this.$store.dispatch('stub/closeStub');
            }
        }
    }
</script>

<style lang="less">
    .stub {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, .6);
        cursor: pointer;
        z-index: 1000;
    }
</style>