import * as VueRouter from "vue-router";

export default VueRouter.createRouter ({

    history: VueRouter.createWebHistory('/'),
    routes: [
        {
            path: '/users',
            component: () => import('./views/user/Index.vue'),
            name: 'users'
        },
        {
            path: '/drivers',
            component: () => import('./views/driver/Index.vue'),
            name: 'drivers'
        },
        {
            path: '/trips',
            component: () => import('./views/trip/Index.vue'),
            name: 'trips'
        },
        {
            path: '/category_comfort',
            component: () => import('./views/trip/Index.vue'),
            name: 'category.comfort'
        },
        {
            path: '/positions',
            component: () => import('./views/trip/Index.vue'),
            name: 'positions'
        },
        {
            path: '/cars',
            component: () => import('./views/trip/Index.vue'),
            name: 'cars'
        }


    ]

})
