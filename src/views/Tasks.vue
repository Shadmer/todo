<template>
    <div class="tasks">
        <div class="tasks__list">
            <todo/>
        </div>
    </div>
</template>

<script>
    import Todo from "@/components/Todo";

    export default {
        name: 'Tasks',
        components: {
            Todo
        },
    }
</script>

<style lang="less">
    .tasks {

    }


</style>