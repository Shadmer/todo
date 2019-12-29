import axios from 'axios';

const state = {
    all: [],
    currentTaskId: 0,
};

const getters = {
    getTasksByCategory: state => category => {
        let filtered = state.all.filter(task => {
            return task.category_id === category;
        });
        return filtered;
    }
};

const mutations = {
    SET_CURRENT_TASK_ID(state, id) {
        state.currentTaskId = id;
    },
    SET_TASKS(state, tasks) {
        state.all = tasks;
    },
    ADD_TASK(state, task) {
        state.all.push(task);
    },
    REMOVE_TASK(state, id) {
        state.all = state.all.filter(task => task.id !== id);
    },
    REMOVE_TASKS_BY_CATEGORY_ID(state, id) {
        state.all = state.all.filter(task => task.category_id !== id);
    },
    REMOVE_COMPLETED_TASKS(state) {
        state.all = state.all
            .filter(task =>
                task.category_id !== this.state.categories.currentCategoryId
                || (task.category_id === this.state.categories.currentCategoryId && !task.completed));
    }
};

const actions = {
    setCurrentTaskId(context, id) {
        context.commit('SET_CURRENT_TASK_ID', id);
    },
    getTasks(context) {
        return new Promise((resolve, reject) => {
            axios({
                method: "get",
                url: "/api/task/get",
            }).then((res) => {
                context.commit('SET_TASKS', res.data);
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
    addTask(context, task) {
        let FD = new FormData();
        FD.append("title", task);
        FD.append("category_id", this.state.categories.currentCategoryId);

        return new Promise((resolve, reject) => {
            axios({
                method: "post",
                url: "/api/task/add",
                data: FD
            }).then((res) => {
                context.commit('ADD_TASK', {
                    "id": res.data.id,
                    "title": task,
                    "completed": false,
                    "category_id": this.state.categories.currentCategoryId,
                    "editing": false,
                });
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
    removeTask(context, id) {
        return new Promise((resolve, reject) => {
            axios({
                method: "delete",
                url: "/api/task/delete/" + id,
            }).then((res) => {
                context.commit('REMOVE_TASK', id);
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
    editTask(context, task) {
        let USP = new URLSearchParams();
        USP.append("title", task.title);
        USP.append("category_id", task.category_id);
        USP.append("completed", Number(task.completed));

        return new Promise((resolve, reject) => {
            axios({
                method: "put",
                url: "/api/task/edit/" + task.id,
                data: USP
            }).then((res) => {
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
    removeTasksByCategoryId(context, id) {
        return new Promise((resolve, reject) => {
            axios({
                method: "delete",
                url: "/api/task/deleteByCategoryId/" + id,
            }).then((res) => {
                context.commit('REMOVE_TASKS_BY_CATEGORY_ID', id);
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
    removeCompletedTasks(context, id) {
        return new Promise((resolve, reject) => {
            axios({
                method: "delete",
                url: "/api/task/deleteCompletedTasks/" + id,
            }).then((res) => {
                context.commit('REMOVE_COMPLETED_TASKS');
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}