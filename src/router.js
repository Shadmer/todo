import Vue from 'vue'
import Router from 'vue-router'
import store from './store/index'

Vue.use(Router)

let isAuth = (to, from, next) => {
    if (store.state.users.user === null) {
        next('/');
    } else {
        next();
    }
};

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'Кабинет',
            component: () => import('./views/Cabinet.vue'),
        },
        {
            path: '/tasks',
            name: 'Задачи',
            component: () => import('./views/Tasks.vue'),
            beforeEnter: isAuth
        },
        {
            path: '/info',
            name: 'Инфо',
            component: () => import('./views/Info.vue'),
            beforeEnter: isAuth
        },
        {
            path: '*',
            name: 'NotFound',
            component: () => import('./views/NotFound.vue')
        },
    ]
});
