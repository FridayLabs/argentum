import {Auth, Account} from '../../api'

const LOAD_ACCOUNT_SUCCESS = 'LOAD_ACCOUNT_SUCCESS'
const LOAD_ACCOUNT_FAIL = 'LOAD_ACCOUNT_FAIL'
const LOGIN_SUCCESS = 'LOGIN_SUCCESS'
const LOGIN_FAIL = 'LOGIN_FAIL'
const LOGOUT = 'LOGOUT'

const state = {
    loggedIn: false,
    account: {}
}

const getters = {
    loggedIn: state => state.loggedIn
}

const actions = {
    checkLogin: ({dispatch, commit, state}) => {
        if (window.localStorage.getItem('token')) {

        }
    },
    login: ({dispatch, commit}, params) => {
        return Auth.login(params)
            .then((response) => {
                commit(LOGIN_SUCCESS, response.body.token)
                dispatch('loadAccount')
                return response
            })
            .catch((response) => {
                commit(LOGIN_FAIL, response.body.error)
                return Promise.reject(response)
            })
    },
    logout: ({commit, state}) => {
        commit(LOGOUT)
    },
    loadAccount: ({commit, state}) => {
        return Account.get({id: 'me'}).then(response => {
            commit(LOAD_ACCOUNT_SUCCESS, response.body)
        }).catch(response => {
            commit(LOAD_ACCOUNT_FAIL, response.error)
        });
    }
}
const mutations = {
    [LOGIN_SUCCESS]: (state, token) => {
        state.loggedIn = true
        window.localStorage.setItem('token', token)
    },
    [LOGIN_FAIL]: (state, error) => {
        state.loggedIn = false
        window.localStorage.removeItem('token')
    },
    [LOGOUT]: (state) => {
        state.loggedIn = false
        window.localStorage.removeItem('token')
    },
    [LOAD_ACCOUNT_SUCCESS]: (state, account) => {
        state.account = account
    },
    [LOAD_ACCOUNT_FAIL]: (state) => {
        state.account = {}
    },
}

export {
    state,
    getters,
    actions,
    mutations
}