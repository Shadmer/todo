import axios from 'axios';

const state = {
    all: []
};

const getters = {};

const mutations = {
    SET_TASKS(state, tasks) {
        state.all = tasks;
    },
    ADD_TASK(state, task) {
        state.all.push(task);
    },
    REMOVE_TASK(state, id) {

        // state.all.forEach((task, i) => {
        //     if (task.id === id) {
        //         state.all.splice(i, 1);
        //         return;
        //     }
        // });

        state.all = state.all.filter(task => task.id !== id);
    },
};

const actions = {
    getTasks(context) {
        axios({
            method: "get",
            url: "/api/task/get",
        }).then((res) => {
            context.commit('SET_TASKS', res.data);
        });
    },
    addTask(context, task) {
        let FD = new FormData();
        FD.append("title", task);
        axios({
            method: "post",
            url: "/api/task/add",
            data: FD
        }).then((res) => {
            context.commit('ADD_TASK', {
                "id": res.data.id,
                "title": task,
                "editing": false,
            })
        });
    },
    removeTask(context, id) {
        axios({
            method: "delete",
            url: "/api/task/delete/" + id,
        }).then(() => {
            context.commit('REMOVE_TASK', id);
        });
    },
    editTask(context, task){
        let USP = new URLSearchParams();
        USP.append("title", task.title);
        USP.append("completed", Number(task.completed));
        axios({
            method: "put",
            url: "/api/task/edit/" + task.id,
            data: USP
        })
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}