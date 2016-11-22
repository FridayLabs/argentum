<template>
    <router-view class="app"></router-view>
</template>

<script>
import Vue from 'vue'
import {mapGetters} from 'vuex'
import router from './router'
import store from './vuex'
import VuexRouterSync from 'vuex-router-sync'

import './components/global'
import './components/async'
import './directives'
import './validators'

VuexRouterSync.sync(store, router)

Vue.use(require('@websanova/vue-auth'), {
  router: router,
  loginData: {url: '/api/auth/login', method: 'POST', redirect: '/'},
  fetchData: {url: '/api/auth/user', method: 'GET'},
  refreshData: {url: '/api/auth/refresh', method: 'GET', atInit: true},
  routerBeforeEach: function(cb) {
        function ccb() {
            var token = window.localStorage.getItem('default-' + this.options.tokenName);
            if (this.watch.authenticated === null && token) {
                if ( ! document.cookie.match(/rememberMe/)) {
                    this.options.logoutProcess.call(this, null, {});
                    this.watch.loaded = true
                    return cb.call(this);
                }
                this.watch.authenticated = false
                this.options.fetchPerform.call(this, {success: cb, error: cb});
            } else {
                this.watch.loaded = true;
                return cb.call(this);
            }
        }
        if (this.options.tokenExpired.call(this)) {
            this.options.refreshPerform.call(this, {success: ccb});
        } else {
            ccb();
        }
  }
});

export default {
  router,
  store,
  components: {
  },
}
</script>
