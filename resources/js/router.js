import * as VueRouter from "vue-router";

export default VueRouter.createRouter ({

    history: VueRouter.createWebHistory('/'),
    routes: [
        {
            path: '/cat_pos',
            component: () => import('./views/category_position/Index.vue'),
            name: 'cat_pos.index'
        },
        {
            path: '/cat_comfort',
            component: () => import('./views/category_comfort/Index.vue'),
            name: 'cat_comfort.index'
        },
        {
            path: '/positions',
            component: () => import('./views/position/Index.vue'),
            name: 'positions.index'
        },
        {
            path: '/users',
            component: () => import('./views/user/Index.vue'),
            name: 'users'
        },
        {
            path: '/trips',
            component: () => import('./views/trip/Index.vue'),
            name: 'trips'
        },

        {
            path: '/cars',
            component: () => import('./views/trip/Index.vue'),
            name: 'cars'
        }


    ]

})
