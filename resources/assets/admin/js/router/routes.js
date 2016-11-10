const routes = [
    {
        path: '/',
        auth: true,
        meta: {requiresAuth: true},
        component: resolve => resolve(require('../views/Base.vue')),
        children: [
            {
                path: '',
                auth: true,
                meta: {requiresAuth: true},
                component: resolve => resolve(require('../views/Project/List.vue'))
            },
            {
                path: '/project/:project_id',
                name: 'project',
                auth: true,
                meta: {requiresAuth: true},
                component: resolve => resolve(require('../views/Project/Details.vue')),
            },
            {
                path: '/project/:project_id/settings',
                name: 'project_settings',
                auth: true,
                meta: {requiresAuth: true},
                component: resolve => resolve(require('../views/Project/Settings.vue')),
            },
            {
                path: '/project/:project_id/page/:id',
                name: 'page',
                auth: true,
                meta: {requiresAuth: true},
                component: resolve => resolve(require('../views/Page/Builder.vue')),
            },
            {
                path: '/project/:project_id/page/:id/settings',
                name: 'page_settings',
                auth: true,
                meta: {requiresAuth: true},
                component: resolve => resolve(require('../views/Page/Settings.vue')),
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: resolve => resolve(require('../views/auth/Login.vue'))
    },
    {
        path: '/logout',
        redirect: function (to) {
            require('../vuex').default.dispatch('logout');
            return {path: '/login'}
        }
    },
    {
        path: '*',
        component: resolve => resolve(require('../views/404.vue'))
    }
]

export default routes