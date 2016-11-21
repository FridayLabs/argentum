import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routes'

Vue.use(VueRouter)

const router = new VueRouter({
  linkActiveClass: 'active',
  mode: 'history',
  base: '/admin/',
  routes
})

router.beforeEach((to, from, next) => {
  var loggedIn = router.app.$options.store.getters.loggedIn;
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!loggedIn) {
      next({
        path: '/login',
        query: {redirect: to.fullPath}
      })
    } else {
      next()
    }
  } else if (loggedIn && to.name == 'login') {
    next({
      path: '/',
      query: to.query
    })
  } else {
    next() // make sure to always call next()!
  }
})

export default router