import Vue from 'vue';
import Vuex from 'vuex';

import tasks from './modules/tasks';
import categories from './modules/categories';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        currentTaskId: 0,
        currentCategoryId: 0,
        stub: false
    },
    mutations: {
        CLOSE_STUB(state) {
          state.stub = false;
        },
        OPEN_STUB(state) {
            state.stub = true;
        },
        SET_CURRENT_TASK_ID(state, id) {
            state.currentTaskId = id;
        },
        SET_CURRENT_CATEGORY_ID(state, id) {
            state.currentCategoryId = id;
        }
    },
    actions: {
        openStub(context) {
            context.commit('OPEN_STUB');
        },
        closeStub(context) {
            context.commit('CLOSE_STUB');
            context.commit('SET_CURRENT_TASK_ID', 0);
        },
        setCurrentTaskId(context, id) {
            context.commit('SET_CURRENT_TASK_ID', id);
        },
        setCurrentCategoryId(context, id) {
            context.commit('SET_CURRENT_CATEGORY_ID', id);
        }
    },
    modules: {
        tasks,
        categories
    }
});
