import axios from 'axios';

const state = {
    all: []
};

const getters = {
    // getTasksByCategory: state => category => {
    //     let filtered = state.all;
    //     filter(task => {
    //         return category
    //     })
    // }
};

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
    REMOVE_TASK_BY_CATEGORY_ID(state, id) {
        state.all = state.all.filter(task => task.category_id !== id);
    }
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
        FD.append("category_id", this.state.currentCategoryId);
        axios({
            method: "post",
            url: "/api/task/add",
            data: FD
        }).then((res) => {
            context.commit('ADD_TASK', {
                "id": res.data.id,
                "title": task,
                "category_id": this.state.currentCategoryId,
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
        USP.append("category_id", task.category_id);
        USP.append("completed", Number(task.completed));
        axios({
            method: "put",
            url: "/api/task/edit/" + task.id,
            data: USP
        })
    },
    removeTaskByCategoryId(context, id) {
        axios({
            method: "delete",
            url: "/api/task/delete/category/" + id,
        }).then(() => {
            context.commit('REMOVE_TASK_BY_CATEGORY_ID', id);
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