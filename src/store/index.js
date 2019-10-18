import Vue from 'vue';
import Vuex from 'vuex';

import tasks from './modules/tasks';
import categories from './modules/categories';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        stub: false
    },
    mutations: {
        CLOSE_STUB(state) {
          state.stub = false;
        },
        OPEN_STUB(state) {
            state.stub = true;
        },
    },
    actions: {
        openStub(context) {
            context.commit('OPEN_STUB');
        },
        closeStub(context) {
            context.commit('CLOSE_STUB');
            // context.commit('SET_CURRENT_TASK_ID', 0);
        },
    },
    modules: {
        tasks,
        categories
    }
});
