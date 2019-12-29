import Vue from 'vue';
import Vuex from 'vuex';

import tasks from './modules/tasks';
import categories from './modules/categories';
import users from './modules/users';
import stub from './modules/stub';
import errors from './modules/errors';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        tasks,
        categories,
        users,
        stub,
        errors
    }
});
