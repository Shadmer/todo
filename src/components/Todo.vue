<template>
    <section class="todo">
        <h2 class="todo__title">Список задач ({{tasksCount}}):</h2>
        <div class="todo__note">
            <small v-if="tasks.length">Кликните дважды, чтобы отредактировать</small>
            <small class="todo__delete-all"
                   v-if="completedTasks.length"
                   @click="removeCompleted()"
            >Удалить завершённые</small>
        </div>
        <ul class="todo__list">
            <li class="todo__item"
                is="ListItem"
                v-for="task in tasks"
                :key="task.id"
                :task="task"
            ></li>
        </ul>
        <div class="todo__add"
             is="AddItem"
             @add="addTask"
             :isFocus="true"
        ></div>
    </section>
</template>

<script>
    import AddItem from "@/components/AddItem";
    import ListItem from "@/components/ListItem";

    export default {
        name: "Todo",
        components: {
            AddItem,
            ListItem
        },
        computed: {
            tasks() {
                return this.$store.getters['tasks/getTasksByCategory'](this.$store.state.categories.currentCategoryId);
            },
            completedTasks() {
                return this.tasks
                    .filter(task => {
                        return task.category_id === this.$store.state.categories.currentCategoryId && task.completed;
                    });
            },
            tasksCount() {
               return this.tasks.length - this.completedTasks.length;
            }

        },
        methods: {
            addTask(title) {
                this.$store.dispatch('tasks/addTask', title);
            },
            removeCompleted() {
                let isDel = confirm('Удалить завершённые задачи?');
                if (!isDel) {
                    return;
                }
                this.$store.dispatch('tasks/removeCompletedTasks', this.$store.state.categories.currentCategoryId);
            }
        },
    }
</script>

<style lang="less">
    .todo {

        &__note {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        &__delete-all {
            cursor: pointer;
            transition: all .3s;

            &:hover {
                text-decoration: underline;
                transform: scale(1.1);
                transition: all .3s;
            }
        }

        &__header {
            border-bottom: 1px solid black;
        }

        &__item {
            border-top: 1px solid gray;
        }
    }
</style>