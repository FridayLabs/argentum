
Vue.use(VueRouter)

var routes = require('./routes');
const router = new VueRouter({
    linkActiveClass: 'active',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!router.app.isLoggedIn) {
            next({
                path: '/admin/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})

export default router