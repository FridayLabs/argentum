import * as API from '../api'
import * as types from './types'

export function getProjects ({commit, state}, params) {
  return API.Project.get(params)
      .then((response) => {
        commit(types.GET_PROJECTS_LIST_SUCCESS, response.body)
        return Promise.resolve(response)
      })
      .catch((response) => {
        commit(types.GET_PROJECTS_LIST_FAIL, response.body)
        return Promise.reject(response)
      })
}

export function getAccount ({commit, state}, params) {
  return API.Account.get(params)
  .then((response) => {
    commit(types.GET_ACCOUNT_SUCCESS, response.body)
    return Promise.resolve(response)
  })
  .catch((response) => {
    commit(types.GET_ACCOUNT_FAIL, response.body)
    return Promise.reject(response)
  })
}

export function login ({commit}, params) {
  return API.Auth.login(params)
  .then((response) => {
    commit(types.AUTH_LOGIN_SUCCESS, response.body)
    return response
  })
  .catch((response) => {
    commit(types.AUTH_LOGIN_FAIL, response.body)
    return Promise.reject(response)
  })
}

export function logout ({commit}, params) {
  commit(types.LOGOUT)
}
