const state = {
    status: false
};

const getters = {};

const mutations = {
    CLOSE_STUB(state) {
        state.status = false;
    },
    OPEN_STUB(state) {
        state.status = true;
    },
};

const actions = {
    openStub(context) {
        context.commit('OPEN_STUB');
    },
    closeStub(context) {
        this.dispatch('tasks/setCurrentTaskId', 0);
        context.commit('CLOSE_STUB');
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}