import Vue from 'vue'
import App from './App.vue'
import store from './store'

import vuetify from './plugins/vuetify';

import axios from 'axios'

import moment from 'moment'

Vue.config.productionTip = false

Vue.prototype.$http = axios
// Sets the default url used by all of this axios instance's requests

axios.defaults.baseURL = process.env.VUE_APP_BASEAPI
axios.defaults.headers.get['Accept'] = 'application/json'
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

Vue.prototype.moment = moment

new Vue({
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
