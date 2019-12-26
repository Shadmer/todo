import axios from 'axios';

const state = {
    user: null,
    name: ''
};

const getters = {};

const mutations = {
    SET_USER(state, user) {
        state.user = user.id;
        state.name = user.name;
    },
};

const actions = {
    getUserId(context) {
        return new Promise((resolve, reject) => {
            axios({
                method: "get",
                url: "/api/user/getUser",
            }).then((res) => {
                context.commit('SET_USER', res.data);
                resolve(res);
            }, error => {
                reject(error);
            });
        });
    },
    registration(context, data) {
        let FD = new FormData();
        FD.append("login", data.login);
        FD.append("password", data.password);

        return new Promise((resolve, reject) => {
            axios({
                method: "post",
                url: "/api/user/registration",
                data: FD
            }).then(res => {
                context.commit('SET_USER', res.data.id);
                resolve(res);
            }, error => {
                reject(error);
            })
        });
    },
    auth(context, data) {
        let FD = new FormData();
        FD.append("login", data.login);
        FD.append("password", data.password);

        return new Promise((resolve, reject) => {
            axios({
                method: "post",
                url: "/api/user/auth",
                data: FD
            }).then(res => {
                context.commit('SET_USER', res.data.id);
                resolve(res)  ;
            }, error => {
                reject(error);
            })
        });
    },
    logout(context) {
        return new Promise((resolve, reject) => {
            axios({
                method: "post",
                url: "/api/user/logout",
            }).then(res => {
                context.commit('SET_USER', null);
                resolve(res)  ;
            }, error => {
                reject(error);
            })
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