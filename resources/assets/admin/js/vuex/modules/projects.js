import * as types from '../types'

const state = {
  error: false,
  projects: []
}

const mutations = {
  [types.GET_PROJECTS_LIST_SUCCESS] (state, data) {
    state.error = false;
    state.projects = data.projects
  },
  [types.GET_PROJECTS_LIST_FAIL] (state, err) {
    console.log(err);
    state.error = true;
    state.projects = []
  },
}

export default {
  state,
  mutations
}
