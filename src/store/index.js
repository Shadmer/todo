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
            this.dispatch('categories/setCurrentCategoryId', this.state.categories.currentCategoryId);
            this.dispatch('tasks/setCurrentTaskId', 0);
            context.commit('CLOSE_STUB');
        },
    },
    modules: {
        tasks,
        categories
    }
});
