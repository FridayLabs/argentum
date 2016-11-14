import Vue from 'vue'
import VueResource from 'vue-resource'

const API_ROOT = '/api'

Vue.use(VueResource)

Vue.http.options.crossOrigin = true
Vue.http.options.xhr = {withCredentials: true}
Vue.http.options.emulateJSON = true

Vue.http.interceptors.push((request, next) => {
  const token = 'Bearer ' + window.localStorage.getItem('token') || ''
  request.headers = request.headers || {}
  request.headers.set('Authorization', token)
  next((response) => {
    if (response.status == 401 && response.body.error == 'token_expired') {
      Auth.refreshToken({token: window.localStorage.getItem('token') || ''}).then((resp) => {
        window.localStorage.setItem('token', resp.body.token)
      });
      return next((response) => {
        return response;
      })
    } else {
      return response
    }
  })
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