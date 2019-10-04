import Vue from 'vue'
import Router from 'vue-router'
import Tasks from './views/Tasks'

Vue.use(Router)

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/tasks',
            name: 'Задачи',
            component: Tasks
        },
        // {
        //     path: '/matrix',
        //     name: 'Матрица',
        //     component: () => import('./views/Matrix.vue')
        // },
        // {
        //     path: '/info',
        //     name: 'Инфо',
        //     component: () => import('./views/Info.vue')
        // },
        // {
        //     path: '/cabinet',
        //     name: 'Кабинет',
        //     component: () => import('./views/Cabinet.vue')
        // },
    ]
})
