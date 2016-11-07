// don't import anything, make sure it's just config
const routes = [
  {
    path: '/',
    component: resolve =>resolve(require('../views/Home/index.vue'))
  },
  {
    path: '/profile',
    auth: true,
    meta: {
      requiresAuth: true
    },
    component: resolve =>resolve(require('../views/Account/Profile.vue'))
  },
  {
    path: '/login',
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