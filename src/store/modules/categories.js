import axios from 'axios';

const state = {
    all: [],
    currentCategoryId: 0,
};

const getters = {};

const mutations = {
    SET_CURRENT_CATEGORY_ID(state, id) {
        state.currentCategoryId = id;
    },
    SET_CATEGORIES(state, categories) {
        state.all = categories;
    },
    ADD_CATEGORY(state, category) {
        state.all.push(category);
    },
    REMOVE_CATEGORY(state, id) {
        state.all = state.all.filter(category => category.id !== id);
    },
};

const actions = {
    setCurrentCategoryId(context, id) {
        context.commit('SET_CURRENT_CATEGORY_ID', id);
    },
    getCategories(context) {
        return new Promise((resolve, reject) => {
            axios({
                method: "get",
                url: "/api/category/get",
            }).then((res) => {
                context.commit('SET_CATEGORIES', res.data);
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
    addCategory(context, task) {
        let FD = new FormData();
        FD.append("title", task);

        return new Promise((resolve, reject) => {
            axios({
                method: "post",
                url: "/api/category/add",
                data: FD
            }).then((res) => {
                context.commit('ADD_CATEGORY', {
                    "id": res.data.id,
                    "title": task
                });
                context.commit('SET_CURRENT_CATEGORY_ID', res.data.id);
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
    editCategory(context, category) {
        let USP = new URLSearchParams();
        USP.append("title", category.title);

        return new Promise((resolve, reject) => {
            axios({
                method: "put",
                url: "/api/category/edit/" + category.id,
                data: USP
            }).then((res) => {
                context.commit('ADD_CATEGORY', {
                    "id": res.data.id,
                    "title": category
                });
                context.commit('SET_CURRENT_CATEGORY_ID', res.data.id);
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
    removeCategory(context, id) {
        return new Promise((resolve, reject) => {
            axios({
                method: "delete",
                url: "/api/category/delete/" + id,
            }).then((res) => {
                context.commit('REMOVE_CATEGORY', id);
                resolve(res);
            }, error => {
                this.dispatch('errors/setError', error.response.data);
                reject(error);
            });
        });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}