import Vue from 'vue'
import VueResource from 'vue-resource'

const API_ROOT = '/api/admin'

Vue.use(VueResource)
Vue.http.options.crossOrigin = true
Vue.http.options.xhr = {withCredentials: true}
Vue.http.options.emulateJSON = true
Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', document.getElementsByName('csrf-token')[0].content);
    next();
})
export const Account = Vue.resource(API_ROOT + '/users{/id}')
export const Project = Vue.resource(API_ROOT + '/project{/id}')
export const Auth = Vue.resource(API_ROOT + '/auth', {}, {
    login: {
        method: 'post',
        url: '/api/auth/login'
    },
    refreshToken: {
        method: 'post',
        url: '/api/auth/refreshToken'
    },
})