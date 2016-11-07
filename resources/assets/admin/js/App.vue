<template>
    <router-view class="router-view"></router-view>
</template>

<script>
import {mapGetters} from 'vuex'
import router from './router'
import store from './vuex'
import VuexRouterSync from 'vuex-router-sync'

import './components/global'
import './components/async'
import './directives'
import './validators'

VuexRouterSync.sync(store, router)

export default {
  router,
  store,
  components: {
  },
  methods: {
    loggedIn () {
      return this.$store.getters.loggedIn;
    }
  },
  created () {
  }
}
</script>
