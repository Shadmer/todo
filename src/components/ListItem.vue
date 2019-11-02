<template>
    <li class="list-item">
        <label class="list-item__complete"
               :class="{'list-item__complete--completed': task.completed}"
               v-if="!editing">
            <span v-if="task.completed">&#10004;</span>
            <input type="checkbox" v-model="task.completed" @change="doneEdit(task)">
        </label>
        <span class="list-item__change" v-if="editing" @mousedown="change(task.id)">&#9998;</span>
        <span class="list-item__task"
              :class="{'list-item__task--completed': task.completed}"
              v-if="!editing"
              @dblclick="startEdit(task)"
        >{{task.title}}</span>
        <input class="list-item__task"
               v-else
               type="text"
               v-model="task.title"
               @blur="doneEdit(task)"
               @keyup.enter="doneEdit(task)"
               @keyup.esc="cancelEdit(task)"
               maxlength="255"
               v-focus
        >
        <span class="list-item__remove" @click="remove(task.id)">&#10008;</span>
    </li>
</template>

<script>
    export default {
        name: "ListItem",
        props: {
            'task': Object,
        },
        directives: {
            focus: {
                inserted: function (el) {
                    el.focus();
                }
            }
        },
        data() {
            return {
                cacheTask: '',
                editing: false
            }
        },
        methods: {
            startEdit(task) {
                this.editing = true;
                this.cacheTask = task.title;
            },
            cancelEdit(task) {
                task.title = this.cacheTask;
                this.editing = false;
                this.cacheTask = '';
            },
            doneEdit(task) {
                if (task.title.trim() === '') {
                    task.title = this.cacheTask;
                    this.editing = false;
                    return;
                }
                this.$store.dispatch('tasks/editTask', task);
                this.editing = false;
                this.cacheTask = '';
            },
            remove(id) {
                let isDel = confirm('Удалить Задачу?');
                if (!isDel) {
                    return;
                }
                this.$store.dispatch('tasks/removeTask', id);
            },
            change(id) {
                this.$store.dispatch('tasks/setCurrentTaskId', id);
                this.$store.dispatch('stub/openStub');
            },
        }
    }
</script>

<style lang="less">
    .list-item {
        position: relative;

        &:hover {
            .list-item__remove {
                opacity: 1;
                transition: all .3s;
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
    }
</style>