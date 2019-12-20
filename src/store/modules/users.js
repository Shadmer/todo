import axios from 'axios';

const state = {
    user: null
};

const getters = {};

const mutations = {
    SET_USER(state, user) {
        state.user = user;
    }
};

const actions = {
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
                resolve(res)  ;
            }, error => {
                reject(error);
            })
        });
    },
    logout(context) {
        context.commit('SET_USER', null);

        // return new Promise((resolve, reject) => {
        //     axios({
        //         method: "post",
        //         url: "/api/user/logout",
        //     }).then(res => {
        //         resolve(res)  ;
        //     }, error => {
        //         reject(error);
        //     })
        // });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}