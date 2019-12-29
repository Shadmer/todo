import config from '@/configs/errors';

const state = {
    errorCode: '',
};

const getters = {
    isError: state => {
        return state.errorCode !== '';
    },
    errorMessage: state => {
        let error = state.errorCode !== ''
            ? config.errors.find(error => error.code == state.errorCode.code)
            : '';
        return error.message;
    }
};

const mutations = {
    SET_ERROR(state, payload) {
        state.errorCode = payload;
    }
};

const actions = {
    setError(context, payload) {
        context.commit('SET_ERROR', payload);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}