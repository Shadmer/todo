import axios from 'axios';

const state = {
    all: [],
};

const getters = {};

const mutations = {
    // ADD_CATEGORY(state, category) {
    //     state.all.push(category);
    // },
};

const actions = {
    addUser(context, data) {
        let FD = new FormData();
        FD.append("login", data.login);
        FD.append("password", data.password);

        axios({
            method: "post",
            url: "/api/user/add",
            data: FD
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