import Vue from 'vue'
import Vuex from 'vuex'
import createLogger from 'vuex/dist/logger'
import * as actions from './actions'
import * as getters from './getters'

import account from './modules/account'
import auth from './modules/auth'
import projects from './modules/projects'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

const store = new Vuex.Store({
  actions,
  getters,
  modules: {
    account,
    auth,
    projects
  },
  strict: false,
  plugins: debug ? [createLogger()] : []
})

export default store
