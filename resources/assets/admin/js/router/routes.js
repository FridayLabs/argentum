// don't import anything, make sure it's just config
const routes = [
    {
        path: '/dashboard',
        auth: true,
        meta: {
            requiresAuth: true
        },
        component: resolve => require(['components/Dashboard.vue'], resolve)
    },
    {
        path: '/login',
        component: resolve => require(['components/LoginPage.vue'], resolve)
    },
    {
        path: '/*',
        component: resolve => require(['components/404.vue'], resolve)
    }
]

export default routes