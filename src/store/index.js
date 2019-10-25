import Vue from 'vue';
import Vuex from 'vuex';

import tasks from './modules/tasks';
import categories from './modules/categories';
import stub from './modules/stub';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        tasks,
        categories,
        stub
    }
});
