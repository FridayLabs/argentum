// don't import anything, make sure it's just config
const routes = [
  {
    path: '/',
    component: resolve =>resolve(require('../views/Home/index.vue'))
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    auth: true,
    meta: {
      requiresAuth: true
    },
    component: resolve =>resolve(require('../views/Account/Dashboard.vue'))
  },
  {
    path: '/login',
    name: 'login',
    component: resolve =>resolve(require('../views/Account/Login.vue'))
  },
  {
    path: '/logout',
    component: resolve =>resolve(require('../views/Account/Logout.vue'))
  },
  {
    path: '*',
    redirect: '/'
  }
]

export default routes