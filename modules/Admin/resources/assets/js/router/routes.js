const routes = [
    {
        path: '/',
        meta: {auth: true},
        component: resolve => resolve(require('../views/Base.vue')),
        children: [
            {
                path: '',
                meta: {auth: true},
                component: resolve => resolve(require('../views/Project/List.vue'))
            },
            {
                path: '/project/create',
                name: 'project_create',
                auth: true,
                meta: {auth: true},
                component: resolve => resolve(require('../views/Project/Create.vue'))
            },
            {
                path: '/project/:project_id',
                name: 'project',
                meta: {auth: true},
                component: resolve => resolve(require('../views/Project/Details.vue')),
            },
            {
                path: '/project/:project_id/settings',
                name: 'project_settings',
                auth: true,
                meta: {auth: true},
                component: resolve => resolve(require('../views/Project/Settings.vue')),
            },
            {
                path: '/project/:project_id/page/:id',
                name: 'page',
                meta: {auth: true},
                component: resolve => resolve(require('../views/Page/Builder.vue')),
            },
            {
                path: '/project/:project_id/page/:id/settings',
                name: 'page_settings',
                meta: {auth: true},
                component: resolve => resolve(require('../views/Page/Settings.vue')),
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        meta: {auth: false},
        component: resolve => resolve(require('../views/Account/Login.vue'))
    },
    {
        path: '/logout',
        meta: {auth: true},
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