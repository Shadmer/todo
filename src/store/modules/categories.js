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
        axios({
            method: "get",
            url: "/api/category",
        }).then((res) => {
            context.commit('SET_CATEGORIES', res.data);
        });
    },
    addCategory(context, task) {
        let FD = new FormData();
        FD.append("title", task);
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
        });
    },
    editCategory(context, category){
        let USP = new URLSearchParams();
        USP.append("title", category.title);
        axios({
            method: "put",
            url: "/api/category/edit/" + category.id,
            data: USP
        })

    },
    removeCategory(context, id) {
        axios({
            method: "delete",
            url: "/api/category/delete/" + id,
        }).then(() => {
            context.commit('REMOVE_CATEGORY', id);
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