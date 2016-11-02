var VueRouter = require('vue-router');
var VueResource = require('vue-resource');

Vue.use(VueRouter);
Vue.use(VueResource);

var router = require('./router');

const app = new Vue({
    router
}).$mount('#app')