import * as types from '../types'

const state = {
  error: false,
  projects: []
}

const mutations = {
  [types.GET_PROJECTS_LIST_SUCCESS] (state, data) {
    state.error = false;
    state.projects = data
  },
  [types.GET_PROJECTS_LIST_FAIL] (state, err) {
    state.error = true;
    state.projects = []
  },
  [types.CRETE_PROJECT] (state, data) {
    state.projects.push(data)
  }
}

export default {
  state,
  mutations
}
