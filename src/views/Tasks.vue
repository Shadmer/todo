<template>
    <div class="tasks">
        <section class="tasks__list" is="Todo"></section>
        <section class="tasks__categories" is="Categories"></section>
    </div>
</template>

<script>
    import Todo from "@/components/Todo";
    import Categories from "@/components/Categories";

    export default {
        name: 'Tasks',
        components: {
            Todo,
            Categories,
        }
    }
</script>

<style lang="less">
    .tasks {
        .row-flex();

        &__list {
            .col();
            .size(8);
        }

        &__categories {
            .col();
            .size(4);
            padding-left: 20px;
            padding-bottom: 20px;
            border-left: 1px solid gray;
            border-bottom: 1px solid gray;
        }
    }


</style>