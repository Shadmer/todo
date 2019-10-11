<template>
    <section class="todo">
        <h2 class="todo__title">Список задач:</h2>
        <small class="todo__note" v-if="tasks[0]">Кликните дважды, чтобы отредактировать</small>
        <ul class="todo__list">
            <li class="todo__item"
                v-for="(task, index) in tasks"
                :key="task.id"
            >
                <label class="todo__complete"
                       :class="{'todo__complete--completed': task.completed}"
                       v-if="index !== editingIndex">
                    <span v-if="task.completed">&#10004;</span>
                    <input type="checkbox" v-model="task.completed" @change="doneEdit(task)">
                </label>
                <span class="todo__change" v-if="index === editingIndex" @mousedown="change(task.id)">&#9998;</span>
                <span class="todo__task"
                      :class="{'todo__task--completed': task.completed}"
                      v-if="index !== editingIndex"
                      @dblclick="edit(task, index)"
                >{{task.title}}</span>
                <input class="todo__task"
                       v-else
                       type="text"
                       v-model="task.title"
                       @blur="doneEdit(task)"
                       @keyup.enter="doneEdit(task)"
                       @keyup.esc="cancelEdit(task)"
                       maxlength="255"
                       v-focus
                >
                <span class="todo__remove" @click="remove(task.id)">&#10008;</span>
            </li>
            <li class="todo__item">
                <span class="todo__add" v-if="isNewTask" @click="add">+</span>
                <input
                    class="todo__task"
                    type="text"
                    v-model="newTask"
                    @keyup.enter="add"
                    maxlength="255"
                    placeholder="Добавить задачу"
                    v-focus
                >
            </li>
        </ul>
    </section>
</template>

<script>
    export default {
        name: "Todo",
        directives: {
            focus: {
                inserted: function (el) {
                    el.focus()
                }
            }
        },
        data() {
            return {
                newTask: '',
                cashTask: '',
                editingIndex: null
            }
        },
        computed: {
            tasks() {
              return this.$store.state.tasks.all;
            },
            isNewTask() {
                return this.newTask.trim() !== '';
            }
        },
        methods: {
            change(id) {
                this.$store.dispatch('setCurrentTaskId', id);
                this.$store.dispatch('openStub');
            },
            add() {
                if (!this.isNewTask) {
                    return;
                }
                this.$store.dispatch('tasks/addTask', this.newTask);
                this.newTask = '';

            },
            remove(id) {
                // let isDel = confirm('Вы хотите удалить задачу?');
                // if (!isDel) {
                //     return;
                // }
                this.$store.dispatch('tasks/removeTask', id);

            },
            edit(task, index) {
                this.editingIndex = index;
                this.cashTask = task.title;
            },
            cancelEdit(task) {
                task.title = this.cashTask;
                this.editingIndex = null;
                this.cashTask = '';

            },
            doneEdit(task) {
                if (task.title.trim() === '') {
                    task.title = this.cashTask;
                    this.editingIndex = null;
                    return;
                }
                this.$store.dispatch('tasks/editTask', task);
                this.editingIndex = null;
                this.cashTask = '';
            },

        },
    }
</script>

<style lang="less">
    .todo {

        &__title {}

        &__note {
            display: block;
            margin-bottom: 20px;
        }

        &__header {
            border-bottom: 1px solid black;
        }

        &__list {}

        &__item {
            position: relative;
            border-bottom: 1px solid gray;

            &:first-child {
                border-top: 1px solid gray;
            }

            &:hover {
                .todo__change {
                    opacity: 1;
                    transition: opacity .3s;
                }

                .todo__remove {
                    opacity: 1;
                    transition: opacity .3s;
                }
            }
        }

        &__add {
            position: absolute;
            top: 50%;
            margin-top: -25px;
            left: 10px;
            font-size: 32px;
            cursor: pointer;
        }

        &__change {
            position: absolute;
            top: 50%;
            margin-top: -19px;
            left: 5px;
            font-size: 24px;
            cursor: pointer;
        }

        &__remove {
            opacity: 0;
            position: absolute;
            top: 50%;
            margin-top: -25px;
            right: 15px;
            cursor: pointer;
            font-size: 32px;
        }

        &__complete {
            position: absolute;
            display: flex;
            top: 50%;
            margin-top: -12px;
            left: 0;
            width: 25px;
            height: 25px;
            border: 1px solid black;
            cursor: pointer;
            transition: opacity .3s;

            span {
                margin: auto;
                font-size: 16px;
            }

            input {
                display: none;
            }

            &--completed {
                border-color: gray;

                span {
                    color: gray;
                }
            }
        }

        &__task {
            display: block;
            width: 100%;
            padding: 15px 40px;
            line-height: 1.15;
            border: 0;
            outline-color: black;
            word-wrap: break-word;

            &--completed {
                color: gray;
                text-decoration: line-through;
            }

        }

    }
</style>