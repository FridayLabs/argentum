Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: 'admin',
    routes: [
        {path: '/login', component: require('./components/LoginPage.vue')},
        {path: '/dashboard', component: require('./components/Dashboard.vue')},
        {path: '/', redirect: to => {
            if(true) {
                return {path: '/login'};
            }
            return {path: '/dashboard'};
        }},
        {path: '/*', component: require('./components/404.vue')}
    ]
});

module.exports = router;