<template>
    <div id="app">
        <table class="table">
            <tr>
                <th>Задача</th>
                <th>Удалить</th>
            </tr>
            <tr v-for="task in tasks" :key="task.id">
                <td>
                    <div
                        v-if="!task.editing"
                        @click="edit(task)"
                        class="view"
                    >{{task.title}}</div>
                    <input
                        v-else
                        type="text"
                        class="edit"
                        v-model="task.title"
                        @blur="doneEdit(task)"
                        @keyup.enter="doneEdit(task)"
                        @keyup.esc="cancelEdit(task)"
                        v-focus>
                </td>
                <td @click="remove(task.id)" class="dt">&times</td>
            </tr>
        </table>
        <hr>
        <input @keyup.enter="add" v-model="newTask" type="text" v-focus>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data() {
            return {
                tasks: [],
                newTask: '',
                cashTask: '',
            }
        },
        created() {
            this.axios({
                method: "get",
                url: "/api/test/get",
            }).then((res) => {
                this.tasks = res.data;
            });
        },
        directives: {
            focus: {
                inserted: function (el) {
                    el.focus()
                }
            }
        },
        methods: {
            add() {
                if (this.newTask.trim() === '') {
                    return;
                }
                let FD = new FormData();
                FD.append("title", this.newTask);
                this.axios({
                    method: "post",
                    url: "/api/test/add",
                    data: FD
                }).then((res) => {
                    this.tasks.push({
                        "id": res.data.id,
                        "title": this.newTask,
                        "editing": false,
                        "id_parent": 0,
                        "is_folder": 0,
                    });
                    this.newTask = '';
                });
            },
            edit(task) {
                task.editing = true;
                this.cashTask = task.title;
            },
            cancelEdit(task) {
                task.editing = false;
                task.title = this.cashTask;
            },
            doneEdit(task) {
                if (task.title.trim() === '') {
                    task.title = this.cashTask;
                    task.editing = false;
                    return;
                }
                let USP = new URLSearchParams();
                USP.append("title", task.title);
                this.axios({
                    method: "put",
                    url: "/api/test/edit/" + task.id,
                    data: USP
                }).then(res => {
                    task.editing = false;
                })
            },
            remove(id) {
                this.axios({
                    method: "delete",
                    url: "/api/test/delete/" + id,
                }).then((res) => {
                    //todo переделать на сплайс
                    this.tasks = this.tasks.filter(task => task.id !== res.data.id);
                });
            }
        }
    }
</script>

<style lang="less">
    #app {
        padding: 0 40px;
    }
    
    td {
        cursor: pointer;
        
        &:hover {
            background-color: #eee;
        }
    }
</style>
